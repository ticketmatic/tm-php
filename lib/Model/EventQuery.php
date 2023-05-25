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
 * Filter parameters to fetch a list of events
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventQuery).
 */
class EventQuery implements \jsonSerializable
{
    /**
     * Create a new EventQuery
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Restrict the event information to a specific context.
     *
     * Currently allows you to filter the event information (both the events and the
     * pricing information within each event) to a specific saleschannel. This makes it
     * very easy to show the correct information on a website.
     *
     * @var \Ticketmatic\Model\EventContext
     */
    public $context;

    /**
     * A SQL query that returns event IDs
     *
     * Can be used to do arbitrary filtering. See the database documentation for event
     * (db/event) for more information.
     *
     * @var string
     */
    public $filter;

    /**
     * Only include events that have been updated since the given timestamp.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Limit results to at most the given amount of events.
     *
     * @var int
     */
    public $limit;

    /**
     * Skip the first X events.
     *
     * @var int
     */
    public $offset;

    /**
     * Order by the given field.
     *
     * Supported values: `name`, `startts`.
     *
     * @var string
     */
    public $orderby;

    /**
     * Output format.
     *
     * Possible values:
     *
     * * **ids**: Only fill the ID field
     *
     * * **default**: Return all event fields (also used when the output parameter is
     * omitted)
     *
     * * **withlookup**: Returns all event fields and an additional `lookup` field
     * which contains all dependent objects
     *
     * @var string
     */
    public $output;

    /**
     * A text filter string.
     *
     * Matches against the start of the event name, the production name or the
     * subtitle.
     *
     * @var string
     */
    public $searchterm;

    /**
     * Filters the events based on a given set of fields. Currently supports:
     * `productionid`, `status` and `pricetypeids`.
     *
     * @var \Ticketmatic\Model\EventFilter
     */
    public $simplefilter;

    /**
     * Unpack EventQuery from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventQuery
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventQuery(array(
            "context" => isset($obj->context) ? EventContext::fromJson($obj->context) : null,
            "filter" => isset($obj->filter) ? $obj->filter : null,
            "lastupdatesince" => isset($obj->lastupdatesince) ? Json::unpackTimestamp($obj->lastupdatesince) : null,
            "limit" => isset($obj->limit) ? $obj->limit : null,
            "offset" => isset($obj->offset) ? $obj->offset : null,
            "orderby" => isset($obj->orderby) ? $obj->orderby : null,
            "output" => isset($obj->output) ? $obj->output : null,
            "searchterm" => isset($obj->searchterm) ? $obj->searchterm : null,
            "simplefilter" => isset($obj->simplefilter) ? EventFilter::fromJson($obj->simplefilter) : null,
        ));
    }

    /**
     * Serialize EventQuery to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->context)) {
            $result["context"] = $this->context;
        }
        if (!is_null($this->filter)) {
            $result["filter"] = strval($this->filter);
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
            $result["simplefilter"] = $this->simplefilter;
        }

        return $result;
    }
}
