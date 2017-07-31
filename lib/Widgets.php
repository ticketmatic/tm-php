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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic;

/**
 * Widget helper
 */
class Widgets {
    /**
     * Create a new widget helper
     *
     * Note that the access key and secret key for widgets are different from
     * the ones used for API calls. You will need to make a separate set of
     * keys to sign widgets.
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
     * Sign a widget URL
     *
     * @param string $widget
     * @param array $parameters
     */
    public function generateUrl($widget, array $parameters) {
        $signature = $this->calculateSignature($parameters);

        $url = Client::$server . "/widgets/" . $this->accountcode . "/" . $widget . "?";
        $urlparams = array();
        foreach ($parameters as $key => $value) {
            $urlparams[] = $key . "=" . rawurlencode($value);
        }
        $urlparams[] = "accesskey=" . $this->accesskey;
        $urlparams[] = "signature=" . $signature;
        $url .= implode("&", $urlparams);

        return $url;
    }

    /**
     * Verify a return URL
     *
     * @param array $parameters
     */
    public function verifyReturnUrl(array $parameters) {
        $params = $parameters;

        if (!isset($params["accesskey"]) || $params["accesskey"] != $this->accesskey) {
            throw new VerifyException("Bad access key");
        }
        unset($params["accesskey"]);

        if (!isset($params["signature"])) {
            throw new VerifyException("Signature missing");
        }
        $sig = $params["signature"];
        unset($params["signature"]);

        $expected = $this->calculateSignature($params);
        if ($expected != $signature) {
            throw new VerifyException("Signature mismatch");
        }
    }

    private function calculateSignature(array $params) {
        unset($params["l"]);
        ksort($params);

        $hash = "";
        foreach ($params as $key => $value) {
            $hash .= $key . $value;
        }

        return hash_hmac("sha256", $this->accesskey.$this->accountcode.$hash, $this->secretkey);
    }
}
