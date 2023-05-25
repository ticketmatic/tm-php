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
 * Required data for splitting an order (api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SplitOrder).
 */
class SplitOrder implements \jsonSerializable
{
    /**
     * Create a new SplitOrder
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The customer for the new order, when not provided will be the same as the
     * current order.
     *
     * @var int
     */
    public $customerid;

    /**
     * The delivery scenario for the new order, when not provided will be the same as
     * the current order.
     *
     * @var int
     */
    public $deliveryscenarioid;

    /**
     * The payment scenario for the new order, when not provided will be the same as
     * the current order.
     *
     * @var int
     */
    public $paymentscenarioid;

    /**
     * Product IDs that need to be moved from the current order to the new one
     *
     * @var int[]
     */
    public $products;

    /**
     * Assign new barcodes to tickets?
     *
     * @var bool
     */
    public $regenerate_barcodes;

    /**
     * Ticket IDs that need to be moved from the current order to the new one
     *
     * @var int[]
     */
    public $tickets;

    /**
     * Unpack SplitOrder from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SplitOrder
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SplitOrder(array(
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "deliveryscenarioid" => isset($obj->deliveryscenarioid) ? $obj->deliveryscenarioid : null,
            "paymentscenarioid" => isset($obj->paymentscenarioid) ? $obj->paymentscenarioid : null,
            "products" => isset($obj->products) ? $obj->products : null,
            "regenerate_barcodes" => isset($obj->regenerate_barcodes) ? $obj->regenerate_barcodes : null,
            "tickets" => isset($obj->tickets) ? $obj->tickets : null,
        ));
    }

    /**
     * Serialize SplitOrder to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
        }
        if (!is_null($this->deliveryscenarioid)) {
            $result["deliveryscenarioid"] = intval($this->deliveryscenarioid);
        }
        if (!is_null($this->paymentscenarioid)) {
            $result["paymentscenarioid"] = intval($this->paymentscenarioid);
        }
        if (!is_null($this->products)) {
            $result["products"] = $this->products;
        }
        if (!is_null($this->regenerate_barcodes)) {
            $result["regenerate_barcodes"] = (bool)$this->regenerate_barcodes;
        }
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
        }

        return $result;
    }
}
