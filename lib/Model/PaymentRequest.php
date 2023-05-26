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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Info for requesting an immediate payment in an order (api/types/Order).
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
     * The language to be used during the payment processing
     *
     * @var string
     */
    public $language;

    /**
     * The returnurl that will be called after the payment request was done.
     *
     * @var string
     */
    public $returnurl;

    /**
     * Create (or use an existing) customer with the PSP. The order needs a linked
     * contact.
     *
     * @var bool
     */
    public $withcustomer;

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
            "language" => isset($obj->language) ? $obj->language : null,
            "returnurl" => isset($obj->returnurl) ? $obj->returnurl : null,
            "withcustomer" => isset($obj->withcustomer) ? $obj->withcustomer : null,
        ));
    }

    /**
     * Serialize PaymentRequest to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->language)) {
            $result["language"] = strval($this->language);
        }
        if (!is_null($this->returnurl)) {
            $result["returnurl"] = strval($this->returnurl);
        }
        if (!is_null($this->withcustomer)) {
            $result["withcustomer"] = (bool)$this->withcustomer;
        }

        return $result;
    }
}
