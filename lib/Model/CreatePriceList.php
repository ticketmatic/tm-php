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
 * A set of fields to create a price list. More info: see the create operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricelists/create).
 */
class CreatePriceList implements \jsonSerializable
{
    /**
     * Create a new CreatePriceList
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var \Ticketmatic\Model\PricelistPrices
     */
    public $prices;

    /**
     * @var bool
     */
    public $hasranks;

    /**
     * Unpack CreatePriceList from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CreatePriceList
     */
    public static function fromJson($obj) {
        return new CreatePriceList(array(
            "name" => $obj->name,
            "prices" => PricelistPrices::fromJson($obj->prices),
            "hasranks" => $obj->hasranks,
        ));
    }

    /**
     * Serialize CreatePriceList to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->prices)) {
                $result["prices"] = $this->prices;
            }
            if (!is_null($this->hasranks)) {
                $result["hasranks"] = boolval($this->hasranks);
            }

        }
        return $result;
    }
}
