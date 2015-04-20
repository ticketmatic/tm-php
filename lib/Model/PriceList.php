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
 * A single price list.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricelists/get)
 * and the price lists endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricelists).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PriceList).
 */
class PriceList implements \jsonSerializable
{
    /**
     * Create a new PriceList
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
     * **Note:** Ignored when creating a new price list.
     *
     * **Note:** Ignored when updating an existing price list.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * **Note:** Not set when retrieving a list of price lists.
     *
     * @var \Ticketmatic\Model\PricelistPrices
     */
    public $prices;

    /**
     * @var bool
     */
    public $hasranks;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when updating an existing price list.
     *
     * **Note:** Ignored when creating a new price list.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new price list.
     *
     * **Note:** Ignored when updating an existing price list.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new price list.
     *
     * **Note:** Ignored when updating an existing price list.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Unpack PriceList from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PriceList
     */
    public static function fromJson($obj) {
        return new PriceList(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "prices" => PricelistPrices::fromJson($obj->prices),
            "hasranks" => $obj->hasranks,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize PriceList to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->prices)) {
                $result["prices"] = $this->prices;
            }
            if (!is_null($this->hasranks)) {
                $result["hasranks"] = boolval($this->hasranks);
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = boolval($this->isarchived);
            }

        }
        return $result;
    }
}
