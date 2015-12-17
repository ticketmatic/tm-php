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
 * A single product in an order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderProduct).
 */
class OrderProduct implements \jsonSerializable
{
    /**
     * Create a new OrderProduct
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Orderproduct ID
     *
     * @var int
     */
    public $id;

    /**
     * Unique code for this orderproduct
     *
     * @var string
     */
    public $code;

    /**
     * Order ID
     *
     * @var int
     */
    public $orderid;

    /**
     * Product ID
     *
     * @var int
     */
    public $productid;

    /**
     * Property values for this product
     *
     * @var string[]
     */
    public $properties;

    /**
     * Ticket price
     *
     * @var float
     */
    public $price;

    /**
     * Vouchercode ID for the voucher that is linked to this orderproduct
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * Unpack OrderProduct from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderProduct
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderProduct(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "productid" => isset($obj->productid) ? $obj->productid : null,
            "properties" => isset($obj->properties) ? $obj->properties : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
        ));
    }

    /**
     * Serialize OrderProduct to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->productid)) {
            $result["productid"] = intval($this->productid);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->vouchercodeid)) {
            $result["vouchercodeid"] = intval($this->vouchercodeid);
        }

        return $result;
    }
}
