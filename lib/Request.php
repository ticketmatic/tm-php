<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        http://www.ticketmatic.com/
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
    }

    /**
     * Execute the request
     *
     * @throws ClientException
     */
    public function run() {
        $headers = array(
            "User-Agent: ticketmatic/php (" . Client::BUILD . ")",
            "Authorization: " . $this->generateAuthHeader(),
        );

        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, $this->generateUrl());
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $this->method);

        if (isset($_SERVER["TM_TRAVIS"])) {
            // Travis has a broken CA cert bundle, ignore errors there
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
        }

        if ($this->client->language) {
            $headers[] = "Accept-Language: " . $this->client->language;
        }

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
        if ($info["http_code"] == 429) {
            throw new RateLimitException(QueueStatus::fromJson(json_decode($output)));
        } else if ($info["http_code"] != 200) {
            if ($info["http_code"] == 0) {
                $output = curl_error($c);
            }
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
     *
     * @param object $obj
     */
    public function setBody($obj) {
        $this->body = $obj;
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
}
