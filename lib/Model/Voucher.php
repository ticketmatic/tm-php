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
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * A single voucher.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_vouchers/get) and the
 * vouchers endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_vouchers).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Voucher).
 */
class Voucher implements \jsonSerializable
{
    /**
     * Create a new Voucher
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new voucher.
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the voucher
     *
     * @var string
     */
    public $name;

    /**
     * Description of the voucher
     *
     * @var string
     */
    public $description;

    /**
     * Definition of the validity of this voucher. Depends on the typeid.
     *
     * **Note:** Not set when retrieving a list of vouchers.
     *
     * @var \Ticketmatic\Model\VoucherValidity
     */
    public $validity;

    /**
     * Ticketlayout to be used for this voucher.
     *
     * @var int
     */
    public $ticketlayoutid;

    /**
     * Paymentmethod to use when creating payments for vouchers of type `payment`.
     *
     * @var int
     */
    public $paymentmethodid;

    /**
     * The number of codes that were created for this voucher.
     *
     * **Note:** Ignored when creating a new voucher.
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var int
     */
    public $nbrofcodes;

    /**
     * Format for the codes for the voucher
     *
     * @var int
     */
    public $codeformatid;

    /**
     * A validation script that is used for vouchers of type order. For each order with
     * a voucher of this type attached, the script will be run to validate the contents
     *
     * @var string
     */
    public $ordervalidationscript;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new voucher.
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new voucher.
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new voucher.
     *
     * **Note:** Ignored when updating an existing voucher.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Unpack Voucher from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Voucher
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Voucher(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "validity" => isset($obj->validity) ? VoucherValidity::fromJson($obj->validity) : null,
            "ticketlayoutid" => isset($obj->ticketlayoutid) ? $obj->ticketlayoutid : null,
            "paymentmethodid" => isset($obj->paymentmethodid) ? $obj->paymentmethodid : null,
            "nbrofcodes" => isset($obj->nbrofcodes) ? $obj->nbrofcodes : null,
            "codeformatid" => isset($obj->codeformatid) ? $obj->codeformatid : null,
            "ordervalidationscript" => isset($obj->ordervalidationscript) ? $obj->ordervalidationscript : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
        ));
    }

    /**
     * Serialize Voucher to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->validity)) {
            $result["validity"] = $this->validity;
        }
        if (!is_null($this->ticketlayoutid)) {
            $result["ticketlayoutid"] = intval($this->ticketlayoutid);
        }
        if (!is_null($this->paymentmethodid)) {
            $result["paymentmethodid"] = intval($this->paymentmethodid);
        }
        if (!is_null($this->nbrofcodes)) {
            $result["nbrofcodes"] = intval($this->nbrofcodes);
        }
        if (!is_null($this->codeformatid)) {
            $result["codeformatid"] = intval($this->codeformatid);
        }
        if (!is_null($this->ordervalidationscript)) {
            $result["ordervalidationscript"] = strval($this->ordervalidationscript);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }

        return $result;
    }
}
