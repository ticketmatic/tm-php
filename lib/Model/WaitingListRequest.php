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
 * A single waiting list request.
 *
 * More info: see the get operation (api/sales/waitinglistrequests/get) and the
 * waiting list requests endpoint (api/sales/waitinglistrequests).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/WaitingListRequest).
 */
class WaitingListRequest implements \jsonSerializable
{
    /**
     * Create a new WaitingListRequest
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new waiting list request.
     *
     * **Note:** Ignored when updating an existing waiting list request.
     *
     * @var int
     */
    public $id;

    /**
     * The id of the order the request is converted to
     *
     * @var int
     */
    public $orderid;

    /**
     * Contact id
     *
     * @var int
     */
    public $contactid;

    /**
     * Show the status of the related items, `29101` = no information provided,
     * `29102` = partial information provided and `29103` = full information provided
     *
     * @var int
     */
    public $itemsstatus;

    /**
     * Show the status of the request, `29201` = requested, `29202` = processed,
     * `29203` = conversion in progress
     *
     * @var int
     */
    public $requeststatus;

    /**
     * The id of the saleschannel used to make the request
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Randomly generated identifier on create. Provides random but consistent ordering
     * of the request (for casting lots)
     *
     * **Note:** Ignored when updating an existing waiting list request.
     *
     * @var int
     */
    public $sortorder;

    /**
     * The request items per event
     *
     * **Note:** Not set when retrieving a list of waiting list requests.
     *
     * @var \Ticketmatic\Model\WaitingListRequestItem[]
     */
    public $waitinglistrequestitems;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new waiting list request.
     *
     * **Note:** Ignored when updating an existing waiting list request.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new waiting list request.
     *
     * **Note:** Ignored when updating an existing waiting list request.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new waiting list request.
     *
     * **Note:** Ignored when updating an existing waiting list request.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

    /**
     * Unpack WaitingListRequest from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\WaitingListRequest
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new WaitingListRequest(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "contactid" => isset($obj->contactid) ? $obj->contactid : null,
            "itemsstatus" => isset($obj->itemsstatus) ? $obj->itemsstatus : null,
            "requeststatus" => isset($obj->requeststatus) ? $obj->requeststatus : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "sortorder" => isset($obj->sortorder) ? $obj->sortorder : null,
            "waitinglistrequestitems" => isset($obj->waitinglistrequestitems) ? Json::unpackArray("WaitingListRequestItem", $obj->waitinglistrequestitems) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));

        $result->custom_fields = array();
        foreach ($obj as $key => $value) {
            if (substr($key, 0, 2) === "c_") {
                $key = substr($key, 2);
                $result->custom_fields[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Serialize WaitingListRequest to JSON.
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
        if (!is_null($this->contactid)) {
            $result["contactid"] = intval($this->contactid);
        }
        if (!is_null($this->itemsstatus)) {
            $result["itemsstatus"] = intval($this->itemsstatus);
        }
        if (!is_null($this->requeststatus)) {
            $result["requeststatus"] = intval($this->requeststatus);
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->sortorder)) {
            $result["sortorder"] = intval($this->sortorder);
        }
        if (!is_null($this->waitinglistrequestitems)) {
            $result["waitinglistrequestitems"] = $this->waitinglistrequestitems;
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }


        if (is_array($this->custom_fields)) {
            foreach ($this->custom_fields as $key => $value) {
                $result["c_" . $key] = $value;
            }
        }

        return $result;
    }
}
