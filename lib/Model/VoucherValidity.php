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
 * The definition of the validity of a voucher.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/VoucherValidity).
 */
class VoucherValidity implements \jsonSerializable
{
    /**
     * Create a new VoucherValidity
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The fixed expiry date for a voucher. The voucher will be valid untill
     * this date (thus if 2020-01-01 is specified, the voucher will remain valid
     * until 2019-12-31 23:59:59). If this is specified, it has preference over
     * expiry_monthsaftercreation.
     *
     * @var \DateTime
     */
    public $expiry_fixeddate;

    /**
     * The relative expiry date for a voucher: voucher code expires this number of
     * months after creation. If expiry_fixeddate is specified, this field is ignored.
     *
     * @var int
     */
    public $expiry_monthsaftercreation;

    /**
     * The max number of times the vouchercode can be used. This field is only relevant
     * for pricetype vouchers.
     *
     * @var int
     */
    public $maxusages;

    /**
     * The max number of times the vouchercode can be used for a single event. This
     * field is only relevant for pricetype vouchers.
     *
     * @var int
     */
    public $maxusagesperevent;

    /**
     * Unpack VoucherValidity from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\VoucherValidity
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new VoucherValidity(array(
            "expiry_fixeddate" => isset($obj->expiry_fixeddate) ? Json::unpackTimestamp($obj->expiry_fixeddate) : null,
            "expiry_monthsaftercreation" => isset($obj->expiry_monthsaftercreation) ? $obj->expiry_monthsaftercreation : null,
            "maxusages" => isset($obj->maxusages) ? $obj->maxusages : null,
            "maxusagesperevent" => isset($obj->maxusagesperevent) ? $obj->maxusagesperevent : null,
        ));
    }

    /**
     * Serialize VoucherValidity to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->expiry_fixeddate)) {
            $result["expiry_fixeddate"] = Json::packTimestamp($this->expiry_fixeddate);
        }
        if (!is_null($this->expiry_monthsaftercreation)) {
            $result["expiry_monthsaftercreation"] = intval($this->expiry_monthsaftercreation);
        }
        if (!is_null($this->maxusages)) {
            $result["maxusages"] = intval($this->maxusages);
        }
        if (!is_null($this->maxusagesperevent)) {
            $result["maxusagesperevent"] = intval($this->maxusagesperevent);
        }

        return $result;
    }
}
