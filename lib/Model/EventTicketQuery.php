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
 * Filter parameters to fetch a list of tickets for an event
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventTicketQuery).
 */
class EventTicketQuery implements \jsonSerializable
{
    /**
     * Create a new EventTicketQuery
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Limit results to at most the given amount of tickets. The default and maximum
     * limit is 5000.
     *
     * @var int
     */
    public $limit;

    /**
     * Skip the first X tickets.
     *
     * @var int
     */
    public $offset;

    /**
     * Filters the tickets based on a given set of fields.
     *
     * @var \Ticketmatic\Model\EventTicketFilter
     */
    public $simplefilter;

    /**
     * Unpack EventTicketQuery from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventTicketQuery
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventTicketQuery(array(
            "limit" => isset($obj->limit) ? $obj->limit : null,
            "offset" => isset($obj->offset) ? $obj->offset : null,
            "simplefilter" => isset($obj->simplefilter) ? EventTicketFilter::fromJson($obj->simplefilter) : null,
        ));
    }

    /**
     * Serialize EventTicketQuery to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->limit)) {
            $result["limit"] = intval($this->limit);
        }
        if (!is_null($this->offset)) {
            $result["offset"] = intval($this->offset);
        }
        if (!is_null($this->simplefilter)) {
            $result["simplefilter"] = $this->simplefilter;
        }

        return $result;
    }
}
