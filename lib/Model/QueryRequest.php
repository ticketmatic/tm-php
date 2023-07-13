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
 * Required data for creating a query on the public data model.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/QueryRequest).
 */
class QueryRequest implements \jsonSerializable
{
    /**
     * Create a new QueryRequest
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Optional limit for the result. Default 100
     *
     * @var int
     */
    public $limit;

    /**
     * Optional offset for the result. Default 0
     *
     * @var int
     */
    public $offset;

    /**
     * Actual query to execute
     *
     * @var string
     */
    public $query;

    /**
     * Unpack QueryRequest from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\QueryRequest
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new QueryRequest(array(
            "limit" => isset($obj->limit) ? $obj->limit : null,
            "offset" => isset($obj->offset) ? $obj->offset : null,
            "query" => isset($obj->query) ? $obj->query : null,
        ));
    }

    /**
     * Serialize QueryRequest to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->limit)) {
            $result["limit"] = intval($this->limit);
        }
        if (!is_null($this->offset)) {
            $result["offset"] = intval($this->offset);
        }
        if (!is_null($this->query)) {
            $result["query"] = strval($this->query);
        }

        return $result;
    }
}
