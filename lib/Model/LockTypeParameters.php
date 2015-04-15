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
 * Set of parameters used to filter lock types. More info: see the getlist
 * operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_locktypes/getlist).
 */
class LockTypeParameters implements \jsonSerializable
{
    /**
     * Create a new LockTypeParameters
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If this parameter is true, archived items will be returned as well.
     *
     * @var bool
     */
    public $includearchived;

    /**
     * All items that were updated since this timestamp will be returned. Timestamp
     * should be passed in `YYYY-MM-DD hh:mm:ss` format.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Filter the returned items by specifying a query on the public datamodel that
     * returns the ids.
     *
     * @var string
     */
    public $filter;

    /**
     * Unpack LockTypeParameters from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\LockTypeParameters
     */
    public static function fromJson($obj) {
        return new LockTypeParameters(array(
            "includearchived" => $obj->includearchived,
            "lastupdatesince" => Json::unpackTimestamp($obj->lastupdatesince),
            "filter" => $obj->filter,
        ));
    }

    /**
     * Serialize LockTypeParameters to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->includearchived)) {
                $result["includearchived"] = boolval($this->includearchived);
            }
            if (!is_null($this->lastupdatesince)) {
                $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
            }
            if (!is_null($this->filter)) {
                $result["filter"] = strval($this->filter);
            }

        }
        return $result;
    }
}
