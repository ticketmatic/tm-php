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
 * Used when importing orders.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ImportProduct).
 */
class ImportProduct implements \jsonSerializable
{
    /**
     * Create a new ImportProduct
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * List of tickets that belong to this bundle.
     *
     * @var \Ticketmatic\Model\ImportBundleTicket[]
     */
    public $bundletickets;

    /**
     * If boolean is set to true, the price field is used (even if set to 0) to
     * determine the price for this product
     *
     * @var bool
     */
    public $overrideprice;

    /**
     * Product price, will always be used if larger than 0.
     *
     * @var float
     */
    public $price;

    /**
     * Indicate which contact is the holder of this product. Currently only used with
     * bundles.
     *
     * @var int
     */
    public $productholderid;

    /**
     * The id for the product you want to add.
     *
     * @var int
     */
    public $productid;

    /**
     * The property values for the product.
     *
     * @var string[]
     */
    public $properties;

    /**
     * If this product references a voucher, set the amount to reserve for this
     * voucher.
     *
     * @var float
     */
    public $voucheramount;

    /**
     * If this product references a voucher, set the code for the voucher that will be
     * created. If not set, the code will be generated.
     *
     * @var string
     */
    public $vouchercode;

    /**
     * If this product references a voucher, set the expiry timestamp for the
     * vouchercode that will be created. If not set, the default timestamp configured
     * in the voucher will be set.
     *
     * @var \DateTime
     */
    public $voucherexpiryts;

    /**
     * Unpack ImportProduct from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ImportProduct
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ImportProduct(array(
            "bundletickets" => isset($obj->bundletickets) ? Json::unpackArray("ImportBundleTicket", $obj->bundletickets) : null,
            "overrideprice" => isset($obj->overrideprice) ? $obj->overrideprice : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "productholderid" => isset($obj->productholderid) ? $obj->productholderid : null,
            "productid" => isset($obj->productid) ? $obj->productid : null,
            "properties" => isset($obj->properties) ? $obj->properties : null,
            "voucheramount" => isset($obj->voucheramount) ? $obj->voucheramount : null,
            "vouchercode" => isset($obj->vouchercode) ? $obj->vouchercode : null,
            "voucherexpiryts" => isset($obj->voucherexpiryts) ? Json::unpackTimestamp($obj->voucherexpiryts) : null,
        ));
    }

    /**
     * Serialize ImportProduct to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->bundletickets)) {
            $result["bundletickets"] = $this->bundletickets;
        }
        if (!is_null($this->overrideprice)) {
            $result["overrideprice"] = (bool)$this->overrideprice;
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->productholderid)) {
            $result["productholderid"] = intval($this->productholderid);
        }
        if (!is_null($this->productid)) {
            $result["productid"] = intval($this->productid);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }
        if (!is_null($this->voucheramount)) {
            $result["voucheramount"] = floatval($this->voucheramount);
        }
        if (!is_null($this->vouchercode)) {
            $result["vouchercode"] = strval($this->vouchercode);
        }
        if (!is_null($this->voucherexpiryts)) {
            $result["voucherexpiryts"] = Json::packTimestamp($this->voucherexpiryts);
        }

        return $result;
    }
}
