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
 * Results of polling the stream
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventstreamItem).
 */
class EventstreamItem implements \jsonSerializable
{
    /**
     * Create a new EventstreamItem
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Id of the event
     *
     * @var string
     */
    public $id;

    /**
     * Eventstream data
     *
     * @var object[]
     */
    public $data;

    /**
     * ISO-8601 timestamp of the event
     *
     * @var string
     */
    public $ts;

    /**
     * Eventstream item type
     *
     * @var string
     */
    public $type;

    /**
     * Unpack EventstreamItem from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventstreamItem
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventstreamItem(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "data" => isset($obj->data) ? $obj->data : null,
            "ts" => isset($obj->ts) ? $obj->ts : null,
            "type" => isset($obj->type) ? $obj->type : null,
        ));
    }

    /**
     * Serialize EventstreamItem to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = strval($this->id);
        }
        if (!is_null($this->data)) {
            $result["data"] = $this->data;
        }
        if (!is_null($this->ts)) {
            $result["ts"] = strval($this->ts);
        }
        if (!is_null($this->type)) {
            $result["type"] = strval($this->type);
        }

        return $result;
    }
}
