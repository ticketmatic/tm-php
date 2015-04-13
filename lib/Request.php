<?php
namespace Ticketmatic;

/**
 * Ticketmatic API REST request
 */
class Request {
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $query;

    /**
     * @var object
     */
    private $body;

    /**
     * Create a new API request.
     *
     * @param string $method;
     * @param string $url;
     */
    public function __construct(Client $client, $method, $url) {
        $this->client = $client;
        $this->method = $method;
        $this->url = $url;

        $this->parameters = array();
        $this->query = array();
        $this->body = null;
    }

    /**
     * Execute the request
     *
     * @throws ClientException
     */
    public function run() {
        $headers = array(
            "User-Agent: ticketmatic/php",
            "Authorization: " . $this->generateAuthHeader(),
        );

        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, $this->generateUrl()); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $this->method);

        if ($this->body != null) {
            $body = array();
            foreach ($this->body as $key => $value) {
                if (!is_null($value)) {
                    $body[$key] = $value;
                }
            }

            $headers[] = "Content-Type: application/json";
            curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        }

        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($c);

        $info = curl_getinfo($c);
        if ($info["http_code"] != 200) {
            throw new ClientException($info["http_code"], $output);
        }

        curl_close($c);

        return json_decode($output);
    }

    /**
     * Add a URL parameter
     *
     * @param string $key
     * @param string $value
     */
    public function addParameter($key, $value) {
        $this->parameters[$key] = $value;
    }

    /**
     * Add a query parameter
     *
     * @param string $key
     * @param string $value
     */
    public function addQuery($key, $value) {
        if (!is_null($value)) {
            $this->query[$key] = $value;
        }
    }

    /**
     * Set request body
     */
    public function setBody($obj) {
        $this->body = $obj;
    }

    private function generateUrl() {
        $url = Client::$server . $this->url;
        foreach ($this->parameters as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }
        $url = str_replace("{accountname}", $this->client->accountcode, $url);

        if (count($this->query) > 0) {
            $queryparts = array();
            foreach ($this->query as $key => $value) {
                $queryparts[] = "$key=" . urlencode($value);
            }
            $url .= "?" . implode("&", $queryparts);
        }
        return $url;
    }

    private function generateAuthHeader() {
        $accountcode = $this->client->accountcode;
        $accesskey = $this->client->accesskey;
        $secretkey = $this->client->secretkey;

        $date = new \DateTime("now", new \DateTimeZone("UTC"));
        $ts = $date->format("Y-m-d\\TH:i:s");

        $signature = hash_hmac('sha256', $accesskey . $accountcode . $ts, $secretkey);
        return "TM-HMAC-SHA256 key=$accesskey ts=$ts sign=$signature";
    }
}
