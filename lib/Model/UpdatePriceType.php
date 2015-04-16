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
 * A set of fields to update a price type.
 *
 * More info: see the update operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricetypes/update)
 * and the price types endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricetypes).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/UpdatePriceType).
 */
class UpdatePriceType implements \jsonSerializable
{
    /**
     * Create a new UpdatePriceType
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Name of the price type
     *
     * @var string
     */
    public $name;

    /**
     * The category of this price type, defines how the price is displayed. The
     * available values for this field can be found on the price type overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricetypes)
     * page.
     *
     * @var int
     */
    public $typeid;

    /**
     * A remark that describes the price type. Will be shown to customers.
     *
     * @var string
     */
    public $remark;

    /**
     * Unpack UpdatePriceType from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\UpdatePriceType
     */
    public static function fromJson($obj) {
        return new UpdatePriceType(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "remark" => $obj->remark,
        ));
    }

    /**
     * Serialize UpdatePriceType to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->remark)) {
                $result["remark"] = strval($this->remark);
            }

        }
        return $result;
    }
}
