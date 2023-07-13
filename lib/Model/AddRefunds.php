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
 * Request data used to refund a payment (api/orders/addrefunds) for an order
 * (api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AddRefunds).
 */
class AddRefunds implements \jsonSerializable
{
    /**
     * Create a new AddRefunds
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Amount that needs to be refunded
     *
     * @var float
     */
    public $amount;

    /**
     * Id of the payment that needs to be refunded
     *
     * @var int
     */
    public $paymentid;

    /**
     * Unpack AddRefunds from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AddRefunds
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AddRefunds(array(
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "paymentid" => isset($obj->paymentid) ? $obj->paymentid : null,
        ));
    }

    /**
     * Serialize AddRefunds to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->paymentid)) {
            $result["paymentid"] = intval($this->paymentid);
        }

        return $result;
    }
}
