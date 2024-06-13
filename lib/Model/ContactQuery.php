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
 * Filter parameters to fetch a list of contacts
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ContactQuery).
 */
class ContactQuery implements \jsonSerializable
{
    /**
     * Create a new ContactQuery
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * A SQL query that returns contact IDs
     *
     * Can be used to do arbitrary filtering. See the database documentation for
     * contact (db/contact) for more information.
     *
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
     * Only include contacts that have been updated since the given timestamp.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Limit results to at most the given amount of contacts.
     *
     * @var int
     */
    public $limit;

    /**
     * Skip the first X contacts.
     *
     * @var int
     */
    public $offset;

    /**
     * Order by the given field.
     *
     * Supported values: `name`, `lastupdatets`, `createdts`.
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
     * * **minimal**: A minimal set of order fields
     *
     * * **default**: Return all order fields (also used when the output parameter is
     * omitted)
     *
     * @var string
     */
    public $output;

    /**
     * A text filter string.
     *
     * Matches against the contact name and contact details.
     *
     * @var string
     */
    public $searchterm;

    /**
     * Unpack ContactQuery from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ContactQuery
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ContactQuery(array(
            "filter" => isset($obj->filter) ? $obj->filter : null,
            "includearchived" => isset($obj->includearchived) ? $obj->includearchived : null,
            "lastupdatesince" => isset($obj->lastupdatesince) ? Json::unpackTimestamp($obj->lastupdatesince) : null,
            "limit" => isset($obj->limit) ? $obj->limit : null,
            "offset" => isset($obj->offset) ? $obj->offset : null,
            "orderby" => isset($obj->orderby) ? $obj->orderby : null,
            "output" => isset($obj->output) ? $obj->output : null,
            "searchterm" => isset($obj->searchterm) ? $obj->searchterm : null,
        ));
    }

    /**
     * Serialize ContactQuery to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->filter)) {
            $result["filter"] = strval($this->filter);
        }
        if (!is_null($this->includearchived)) {
            $result["includearchived"] = (bool)$this->includearchived;
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

        return $result;
    }
}
