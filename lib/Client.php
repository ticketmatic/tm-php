<?php
namespace Ticketmatic;

/**
 * Ticketmatic API REST client
 */
class Client {
    /**
     * Server URL.
     *
     * Exposed to allow overriding during tests.
     *
     * @var string
     */
    public static $server = "https://apps.ticketmatic.com/api";

    /**
     * @var string
     */
    public $accountcode;

    /**
     * @var string
     */
    public $accesskey;

    /**
     * @var string
     */
    public $secretkey;

    /**
     * Create a new API client.
     *
     * @param string $accountcode
     * @param string $accesskey
     * @param string $secretkey
     */
    public function __construct($accountcode, $accesskey, $secretkey) {
        $this->accountcode = $accountcode;
        $this->accesskey = $accesskey;
        $this->secretkey = $secretkey;
    }

    /**
     * Create a new API request.
     *
     * @param string $method
     * @param string $url
     *
     * @return Request
     */
    public function newRequest($method, $url) {
        return new Request($this, $method, $url);
    }
}
