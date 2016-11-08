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
 * Parameters used to create voucher codes
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AddVoucherCodes).
 */
class AddVoucherCodes implements \jsonSerializable
{
    /**
     * Create a new AddVoucherCodes
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Value of the voucher
     *
     * @var float
     */
    public $amount;

    /**
     * Code IDs (optional). Random codes will be generated when omitted.
     *
     * @var string[]
     */
    public $codes;

    /**
     * Number of codes to create
     *
     * @var int
     */
    public $count;

    /**
     * Unpack AddVoucherCodes from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AddVoucherCodes
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AddVoucherCodes(array(
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "codes" => isset($obj->codes) ? $obj->codes : null,
            "count" => isset($obj->count) ? $obj->count : null,
        ));
    }

    /**
     * Serialize AddVoucherCodes to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->codes)) {
            $result["codes"] = $this->codes;
        }
        if (!is_null($this->count)) {
            $result["count"] = intval($this->count);
        }

        return $result;
    }
}
