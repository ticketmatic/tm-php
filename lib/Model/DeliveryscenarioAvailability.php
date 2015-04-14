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

class DeliveryscenarioAvailability implements \jsonSerializable
{
    /**
     * Create a new DeliveryscenarioAvailability
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * An array of sales channel IDs for which this delivery scenario can be used.
     *
     * @var int[]
     */
    public $saleschannels;

    /**
     * Use a script to refine the set of sales channels?
     *
     * @var bool
     */
    public $usescript;

    /**
     * Script used to determine availability of the delivery scenario. More info on the
     * delivery scenario overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios)
     * page.
     *
     * @var string
     */
    public $script;

    /**
     * Unpack DeliveryscenarioAvailability from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\DeliveryscenarioAvailability
     */
    public static function fromJson($obj) {
        return new DeliveryscenarioAvailability(array(
            "saleschannels" => Json::unpackArray("int", $obj->saleschannels),
            "usescript" => $obj->usescript,
            "script" => $obj->script,
        ));
    }

    /**
     * Serialize DeliveryscenarioAvailability to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->saleschannels)) {
                $result["saleschannels"] = $this->saleschannels;
            }
            if (!is_null($this->usescript)) {
                $result["usescript"] = boolval($this->usescript);
            }
            if (!is_null($this->script)) {
                $result["script"] = strval($this->script);
            }

        }
        return $result;
    }
}
