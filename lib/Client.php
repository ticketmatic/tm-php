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

/**
 * Ticketmatic API REST client
 */
class Client {
    /**
     * Server URL
     *
     * Exposed to allow overriding during tests.
     *
     * @var string
     */
    public static $server = "https://apps.ticketmatic.com";

    /**
     * API Version
     *
     * @var string
     */
    public static $version = "1";

    /**
     * Library Version
     *
     * @var string
     */
    const BUILD = "1.0.122";

    /**
     * Account code
     *
     * @var string
     */
    public $accountcode;

    /**
     * API access key
     * @var string
     */
    public $accesskey;

    /**
     * Private API key
     *
     * @var string
     */
    public $secretkey;

    /**
     * Language
     *
     * @var string
     */
    public $language;

    /**
     * Callback called on every new request created
     *
     * @var \Closure
     */
    private $newRequestEventCallback;

    /**
     * Create a new API client
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
        $request = new Request($this, $method, $url);
        if (isset($this->newRequestEventCallback)) {
            ($this->newRequestEventCallback)($request);
        }
        return $request;
    }

    /**
     * Set client language.
     *
     * @param string $lang
     */
    public function setLanguage($lang) {
        $this->language = $lang;
    }

    /**
     * Set new request event callback
     *
     * @param \Closure $newRequestEventCallback
     */
    public function setNewRequestEventCallback(\Closure $newRequestEventCallback) {
        $this->newRequestEventCallback = $newRequestEventCallback;
    }
}
