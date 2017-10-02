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
 * Log item returned when requesting the log history of an order (api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/LogItem).
 */
class LogItem implements \jsonSerializable
{
    /**
     * Create a new LogItem
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Id of the log item
     *
     * @var int
     */
    public $id;

    /**
     * Order id
     *
     * @var int
     */
    public $orderid;

    /**
     * Log item type
     *
     * @var int
     */
    public $typeid;

    /**
     * Info
     *
     * @var object[]
     */
    public $info;

    /**
     * Lookup info
     *
     * @var object[]
     */
    public $lookupinfo;

    /**
     * Model
     *
     * @var object[]
     */
    public $model;

    /**
     * Log item timestamp
     *
     * @var \DateTime
     */
    public $ts;

    /**
     * User id
     *
     * @var int
     */
    public $userid;

    /**
     * User name
     *
     * @var string
     */
    public $username;

    /**
     * Unpack LogItem from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\LogItem
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new LogItem(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "info" => isset($obj->info) ? $obj->info : null,
            "lookupinfo" => isset($obj->lookupinfo) ? $obj->lookupinfo : null,
            "model" => isset($obj->model) ? $obj->model : null,
            "ts" => isset($obj->ts) ? Json::unpackTimestamp($obj->ts) : null,
            "userid" => isset($obj->userid) ? $obj->userid : null,
            "username" => isset($obj->username) ? $obj->username : null,
        ));
    }

    /**
     * Serialize LogItem to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->info)) {
            $result["info"] = $this->info;
        }
        if (!is_null($this->lookupinfo)) {
            $result["lookupinfo"] = $this->lookupinfo;
        }
        if (!is_null($this->model)) {
            $result["model"] = $this->model;
        }
        if (!is_null($this->ts)) {
            $result["ts"] = Json::packTimestamp($this->ts);
        }
        if (!is_null($this->userid)) {
            $result["userid"] = intval($this->userid);
        }
        if (!is_null($this->username)) {
            $result["username"] = strval($this->username);
        }

        return $result;
    }
}
