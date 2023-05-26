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
 * ## Type
 *
 * The `typeid` field of an order log can have any of the following values:
 *
 * * **Create order (`18001`)**
 *
 * * **Remove order (`18002`)**
 *
 * * **Add tickets (`18003`)**
 *
 * * **Remove tickets (`18004`)**
 *
 * * **Update tickets (`18005`)**
 *
 * * **Confirm order (`18006`)**
 *
 * * **Link customer (`18007`)**
 *
 * * **Remove customer (`18008`)**
 *
 * * **Move tickets (`18009`)**
 *
 * * **Update price type (`18010`)**
 *
 * * **Add payment (`18011`)**
 *
 * * **Set payment scenario (`18012`)**
 *
 * * **Set delivery scenario (`18013`)**
 *
 * * **Order delivered (`18014`)**
 *
 * * **Mail sent (`18015`)**
 *
 * * **Custom fields updated (`18016`)**
 *
 * * **Rappel date updated (`18017`)**
 *
 * * **Expiry date updated (`18018`)**
 *
 * * **Scan ticket (`18019`)**
 *
 * * **Add products (`18020`)**
 *
 * * **Remove products (`18021`)**
 *
 * * **Payment request created (`18022`)**
 *
 * * **Payment request confirmed (`18023`)**
 *
 * * **Payment request cancelled (`18024`)**
 *
 * * **Remove payment (`18025`)**
 *
 * * **Mail not delivered (`18026`)**
 *
 * * **Split order (`18027`)**
 *
 * * **Tickets/documents downloaded (`18028`)**
 *
 * * **Tickets/documents downloaded via API (`18029`)**
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
     * @return mixed
     */
    public function jsonSerialize(): mixed {
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
