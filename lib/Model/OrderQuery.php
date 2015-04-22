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

class OrderQuery implements \jsonSerializable
{
    /**
     * Create a new OrderQuery
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
    public $filter;

    /**
     * If this parameter is true, archived items will be returned as well.
     *
     * @var bool
     */
    public $includearchived;

    /**
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * @var int
     */
    public $limit;

    /**
     * @var int
     */
    public $offset;

    /**
     * @var string
     */
    public $orderby;

    /**
     * @var string
     */
    public $output;

    /**
     * @var string
     */
    public $searchterm;

    /**
     * @var string
     */
    public $simplefilter;

    /**
     * Unpack OrderQuery from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderQuery
     */
    public static function fromJson($obj) {
        return new OrderQuery(array(
            "filter" => $obj->filter,
            "includearchived" => $obj->includearchived,
            "lastupdatesince" => Json::unpackTimestamp($obj->lastupdatesince),
            "limit" => $obj->limit,
            "offset" => $obj->offset,
            "orderby" => $obj->orderby,
            "output" => $obj->output,
            "searchterm" => $obj->searchterm,
            "simplefilter" => $obj->simplefilter,
        ));
    }

    /**
     * Serialize OrderQuery to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->filter)) {
                $result["filter"] = strval($this->filter);
            }
            if (!is_null($this->includearchived)) {
                $result["includearchived"] = boolval($this->includearchived);
            }
            if (!is_null($this->lastupdatesince)) {
                $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
            }
            if (!is_null($this->limit)) {
                $result["limit"] = intval($this->limit);
            }
            if (!is_null($this->offset)) {
                $result["offset"] = intval($this->offset);
            }
            if (!is_null($this->orderby)) {
                $result["orderby"] = strval($this->orderby);
            }
            if (!is_null($this->output)) {
                $result["output"] = strval($this->output);
            }
            if (!is_null($this->searchterm)) {
                $result["searchterm"] = strval($this->searchterm);
            }
            if (!is_null($this->simplefilter)) {
                $result["simplefilter"] = strval($this->simplefilter);
            }

        }
        return $result;
    }
}
