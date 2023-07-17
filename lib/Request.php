<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic;

use \Ticketmatic\Model\QueueStatus;

/**
 * Ticketmatic API REST request
 */
class Request {
    /**
     * API client
     *
     * @var Client
     */
    private $client;

    /**
     * HTTP method
     *
     * @var string
     */
    private $method;

    /**
     * Path of the API call
     *
     * @var string
     */
    private $url;

    /**
     * URL parameters
     *
     * @var array
     */
    private $parameters;

    /**
     * Query parameters
     *
     * @var array
     */
    private $query;

    /**
     * Request body
     *
     * @var object
     */
    private $body;

    /**
     * Response headers
     *
     * @var array
     */
    private $responseHeaders;

    /**
     * The number of milliseconds to wait while trying to connect
     *
     * @var int
     */
    private $connectTimeoutMs;

    /**
     * The maximum number of milliseconds to allow the request to execute
     *
     * @var int
     */
    private $timeoutMs;

    /**
     * The proxy to tunnel requests through
     *
     * @var string
     */
    private $proxy;

    /**
     * FALSE to stop cURL from verifying the peer's certificate.
     *
     * @var bool
     */
    private $sslVerifyPeer;

    /**
     * Create a new API request.
     *
     * @param Client $client
     * @param string $method
     * @param string $url
     */
    public function __construct(Client $client, $method, $url) {
        $this->client = $client;
        $this->method = $method;
        $this->url = $url;

        $this->parameters = array();
        $this->query = array();
        $this->body = null;
        $this->bodycontenttype = "json";
        $this->responseHeaders = array();
    }

    /**
     * Execute the request
     *
     * @param string $contenttype
     * @throws ClientException
     */
    public function run($contenttype = "json") {
        $c = $this->prepare();

        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($c);
        self::checkError($c, $output, $this->responseHeaders);
        curl_close($c);

        if ($contenttype == "json") {
            return json_decode($output);
        }
        return $output;
    }

    /**
     * Execute the request, as a stream
     *
     * @throws ClientException
     */
    public function stream() {
        $c = $this->prepare();

        return new Stream($c);
    }

    /**
     * Prepare the request
     */
    private function prepare() {
        $headers = array(
            "User-Agent: ticketmatic/php (" . Client::BUILD . ")",
            "Authorization: " . $this->generateAuthHeader(),
        );

        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, $this->generateUrl());
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($c, CURLOPT_HEADERFUNCTION, array($this, 'handleHeader'));

        if (isset($this->sslVerifyPeer)) {
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, $this->sslVerifyPeer);
        }
        if (isset($_SERVER["TM_TRAVIS"])) {
            // Travis has a broken CA cert bundle, ignore errors there
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
        }

        if (isset($this->connectTimeoutMs)) {
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT_MS, $this->connectTimeoutMs);
        }
        if (isset($this->timeoutMs)) {
            curl_setopt($c, CURLOPT_TIMEOUT_MS, $this->timeoutMs);
        }
        if (!empty($this->proxy)) {
            list($proxy, $proxyPort) = explode(':', $this->proxy);
            curl_setopt($c, CURLOPT_PROXY, $proxy);
            if (ctype_digit($proxyPort)) {
                curl_setopt($c, CURLOPT_PROXYPORT, $proxyPort);
            }
        }

        if ($this->client->language) {
            $headers[] = "Accept-Language: " . $this->client->language;
        }

        if ($this->body != null) {
            $body = array();
            $headers[] = "Expect:"; // issue with cURL when doing big size POSTs https://stackoverflow.com/questions/14158675/how-can-i-stop-curl-from-using-100-continue
            if ($this->bodycontenttype == "json") {
                foreach ($this->body as $key => $value) {
                    $body[$key] = $value;
                }
                $body = json_encode($body);
                $headers[] = "Content-Type: application/json";
            } else if ($this->bodycontenttype == "svg") {
                $body = $this->body;
                $headers[] = "Content-Type: image/svg+xml";
            }
            curl_setopt($c, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);

        return $c;
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
     *
     * @param object $obj
     */
    public function setBody($obj, $bodycontenttype="json") {
        $this->body = $obj;
        $this->bodycontenttype = $bodycontenttype;
    }

    /**
     * Generate a full API call URL
     *
     * @return string
     */
    private function generateUrl() {
        $url = Client::$server . "/api/" . Client::$version . $this->url;
        foreach ($this->parameters as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }
        $url = str_replace("{accountname}", $this->client->accountcode, $url);

        if (count($this->query) > 0) {
            $queryparts = array();
            foreach ($this->query as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $queryparts[] = "$key=" . urlencode(json_encode($value));
                } else {
                    $queryparts[] = "$key=" . urlencode($value);
                }
            }
            $url .= "?" . implode("&", $queryparts);
        }
        return $url;
    }

    /**
     * Generate an Authorization header.
     *
     * @link https://apps.ticketmatic.com/#/knowledgebase/api/coreconcepts_authentication
     *
     * @return string
     */
    private function generateAuthHeader() {
        $accountcode = $this->client->accountcode;
        $accesskey = $this->client->accesskey;
        $secretkey = $this->client->secretkey;

        $date = new \DateTime("now", new \DateTimeZone("UTC"));
        $ts = $date->format("Y-m-d\\TH:i:s");

        $signature = hash_hmac('sha256', $accesskey . $accountcode . $ts, $secretkey);
        return "TM-HMAC-SHA256 key=$accesskey ts=$ts sign=$signature";
    }

    /**
     * Check for an error response
     *
     * @param resource $c
     * @param string $output
     *
     * @throws RateLimitException
     * @throws ClientException
     */
    public static function checkError($c, $output, array $headers = array()) {
        $info = curl_getinfo($c);
        if ($info["http_code"] == 0) {
            return; // Still running
        }

        if ($info["http_code"] == 429) {
            $backoff = isset($headers["retry-after"]) ? $headers["retry-after"] : 0;
            throw new RateLimitException($backoff);
        }
        else {
            if ($info["http_code"] == 200) {
                // time-outs have a 200 code incl. an error, so we should check it
                $output = curl_error($c);

                // No error, so return
                if (empty($output)) {
                    return;
                }
            }
            throw new ClientException($info["http_code"], $output);
        }
    }

    public function handleHeader($curl, $header) {
        if (strpos($header, ": ")) {
            list($key, $val) = explode(": ", trim($header), 2);
            $this->responseHeaders[strtolower($key)] = $val;
        }
        return strlen($header);
    }

    /**
     * Set number of milliseconds to wait while trying to connect
     * Use 0 to wait indefinitely.
     *
     * @param int $connectTimeoutMs
     *
     */
    public function setConnectTimeoutMs(int $connectTimeoutMs) {
        $this->connectTimeoutMs = $connectTimeoutMs;
    }

    /**
     * Set maximum time the request is allowed to take in milliseconds
     * Use 0 to wait indefinitely.
     *
     * @param int $timeoutMs
     *
     */
    public function setTimeoutMs(int $timeoutMs) {
        $this->timeoutMs = $timeoutMs;
    }

    /**
     * The proxy to tunnel requests through
     * Use : seperator to to add a port
     *
     * @param string $proxy
     *
     */
    public function setProxy(string $proxy) {
        $this->proxy = $proxy;
    }

    /**
     * FALSE to stop cURL from verifying the peer's certificate.
     *
     * @param bool $sslVerifyPeer
     *
     */
    public function setSslVerifyPeer(bool $sslVerifyPeer) {
        $this->sslVerifyPeer = $sslVerifyPeer;
    }
}
