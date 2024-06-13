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
 * Product instance value, used with products. It configures the price and the
 * content of a product.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ProductInstanceValue).
 */
class ProductInstanceValue implements \jsonSerializable
{
    /**
     * Create a new ProductInstanceValue
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Maximum price for a variable payment voucher
     *
     * @var float
     */
    public $max_price;

    /**
     * Minimum price for a variable payment voucher
     *
     * @var float
     */
    public $min_price;

    /**
     * Price
     *
     * @var float
     */
    public $price;

    /**
     * Set of pricetype values (used in optionbundle products)
     *
     * @var \Ticketmatic\Model\ProductInstancePricetypeValue[]
     */
    public $pricetypes;

    /**
     * Set of tickettypeprices (used in fixedbundle products)
     *
     * @var int[]
     */
    public $tickettypeprices;

    /**
     * Set of tickettypes (used in optionbundle products)
     *
     * @var int[]
     */
    public $tickettypes;

    /**
     * Voucher
     *
     * @var \Ticketmatic\Model\ProductVoucherValue
     */
    public $voucher;

    /**
     * Unpack ProductInstanceValue from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ProductInstanceValue
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ProductInstanceValue(array(
            "max_price" => isset($obj->max_price) ? $obj->max_price : null,
            "min_price" => isset($obj->min_price) ? $obj->min_price : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "pricetypes" => isset($obj->pricetypes) ? Json::unpackArray("ProductInstancePricetypeValue", $obj->pricetypes) : null,
            "tickettypeprices" => isset($obj->tickettypeprices) ? $obj->tickettypeprices : null,
            "tickettypes" => isset($obj->tickettypes) ? $obj->tickettypes : null,
            "voucher" => isset($obj->voucher) ? ProductVoucherValue::fromJson($obj->voucher) : null,
        ));
    }

    /**
     * Serialize ProductInstanceValue to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->max_price)) {
            $result["max_price"] = floatval($this->max_price);
        }
        if (!is_null($this->min_price)) {
            $result["min_price"] = floatval($this->min_price);
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->pricetypes)) {
            $result["pricetypes"] = $this->pricetypes;
        }
        if (!is_null($this->tickettypeprices)) {
            $result["tickettypeprices"] = $this->tickettypeprices;
        }
        if (!is_null($this->tickettypes)) {
            $result["tickettypes"] = $this->tickettypes;
        }
        if (!is_null($this->voucher)) {
            $result["voucher"] = $this->voucher;
        }

        return $result;
    }
}
