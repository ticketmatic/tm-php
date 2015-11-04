<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Info for requesting an immediate payment in an order
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PaymentRequest).
 */
class PaymentRequest implements \jsonSerializable
{
    /**
     * Create a new PaymentRequest
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The returnurl that will be called after the payment request was done.
     *
     * @var string
     */
    public $returnurl;

    /**
     * The language to be used during the payment processing
     *
     * @var string
     */
    public $language;

    /**
     * Unpack PaymentRequest from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PaymentRequest
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PaymentRequest(array(
            "returnurl" => isset($obj->returnurl) ? $obj->returnurl : null,
            "language" => isset($obj->language) ? $obj->language : null,
        ));
    }

    /**
     * Serialize PaymentRequest to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->returnurl)) {
            $result["returnurl"] = strval($this->returnurl);
        }
        if (!is_null($this->language)) {
            $result["language"] = strval($this->language);
        }

        return $result;
    }
}
