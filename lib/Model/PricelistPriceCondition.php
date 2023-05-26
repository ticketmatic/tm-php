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
 * These are the possible condition and example values:
 *
 * ## Ticketlimit
 *
 * There is a limited amount of tickets available for the selected pricetype.
 *
 * ```json
 * {
 *     "type": "ticketlimit", 
 *     "value": 10
 * }
 * ```
 *
 * ## Date validity
 *
 * The price type is only available in this period.
 *
 * ### Absolute
 *
 * ```json
 * {
 *     "type": "date", 
 *     "value": {
 *         "datetype": "absolute", 
 *         "absoluteStart": "2015-05-20", 
 *         "absoluteEnd": "2015-05-27"
 *     }
 * }
 * ```
 *
 * ### Relative
 *
 * ```json
 * {
 *     "type": "date", 
 *     "value": {
 *         "datetype": "relative_eventdate", 
 *         "relativeStart": 10, 
 *         "relativeEnd": 5
 *     }
 * }
 * ```
 *
 * ## Promocode
 *
 * The price type is only available if the customer provides a promocode.
 *
 * ```json
 * {
 *     "type": "promocode", 
 *     "value": ["TM"]
 * }
 * ```
 *
 * ## Max number of tickets per customer
 *
 * Limit the maximum number of tickets a customer can buy of this specific price
 * type.
 *
 * ```json
 * {
 *     "type": "orderticketlimit", 
 *     "value": 2
 * }
 * ```
 *
 * ## Voucherids
 *
 * When buying a ticket of this pricetype, a valid vouchercode with voucherid one
 * of the values should be attached to the ticket.
 *
 * ```json
 * {
 *     "type": "voucherids",
 *     "value": [1,2,3]
 * }
 * ```
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PricelistPriceCondition).
 */
class PricelistPriceCondition implements \jsonSerializable
{
    /**
     * Create a new PricelistPriceCondition
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The type of condition. Possible values:
     *
     * * `ticketlimit`
     *
     * * `date`
     *
     * * `promocode`
     *
     * * `orderticketlimit`
     *
     * * `voucherids`
     *
     * @var string
     */
    public $type;

    /**
     * The value of this condition. See type for info about what should be filled in.
     *
     * @var object
     */
    public $value;

    /**
     * Unpack PricelistPriceCondition from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PricelistPriceCondition
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PricelistPriceCondition(array(
            "type" => isset($obj->type) ? $obj->type : null,
            "value" => isset($obj->value) ? $obj->value : null,
        ));
    }

    /**
     * Serialize PricelistPriceCondition to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->type)) {
            $result["type"] = strval($this->type);
        }
        if (!is_null($this->value)) {
            $result["value"] = $this->value;
        }

        return $result;
    }
}
