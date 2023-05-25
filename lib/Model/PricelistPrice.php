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
 * You can find more information about price in the endpoint documentation
 * (api/settings/pricing/pricelists).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PricelistPrice).
 */
class PricelistPrice implements \jsonSerializable
{
    /**
     * Create a new PricelistPrice
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Array of booleans indicating if the corresponding price is available for this
     * PricelistPrice. Should contain the same number of booleans as prices.
     *
     * @var bool[]
     */
    public $availabilities;

    /**
     * Extra conditions for this price. This can be a promocode, a ticketlimit per
     * order, ... .
     *
     * @var \Ticketmatic\Model\PricelistPriceCondition[]
     */
    public $conditions;

    /**
     * Optional, and only used for eventspecificprices. Indicates the position of this
     * price in the pricelist.
     *
     * @var int
     */
    public $position;

    /**
     * The (decimal) prices for this PricelistPrice. If no seatrankids has been set,
     * this should consist of 1 price. If seatrankids are set this should an equal
     * number of prices as the number of seatranks.
     *
     * @var float[]
     */
    public $prices;

    /**
     * The pricetype for this price.
     *
     * @var int
     */
    public $pricetypeid;

    /**
     * The list of saleschannels for which this PricelistPrice is active.
     *
     * @var int[]
     */
    public $saleschannels;

    /**
     * Unpack PricelistPrice from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PricelistPrice
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PricelistPrice(array(
            "availabilities" => isset($obj->availabilities) ? $obj->availabilities : null,
            "conditions" => isset($obj->conditions) ? Json::unpackArray("PricelistPriceCondition", $obj->conditions) : null,
            "position" => isset($obj->position) ? $obj->position : null,
            "prices" => isset($obj->prices) ? $obj->prices : null,
            "pricetypeid" => isset($obj->pricetypeid) ? $obj->pricetypeid : null,
            "saleschannels" => isset($obj->saleschannels) ? $obj->saleschannels : null,
        ));
    }

    /**
     * Serialize PricelistPrice to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->availabilities)) {
            $result["availabilities"] = $this->availabilities;
        }
        if (!is_null($this->conditions)) {
            $result["conditions"] = $this->conditions;
        }
        if (!is_null($this->position)) {
            $result["position"] = intval($this->position);
        }
        if (!is_null($this->prices)) {
            $result["prices"] = $this->prices;
        }
        if (!is_null($this->pricetypeid)) {
            $result["pricetypeid"] = intval($this->pricetypeid);
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }

        return $result;
    }
}
