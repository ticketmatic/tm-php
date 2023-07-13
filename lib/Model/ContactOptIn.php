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
 * A single contact opt-in.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ContactOptIn).
 */
class ContactOptIn implements \jsonSerializable
{
    /**
     * Create a new ContactOptIn
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
     * @var int
     */
    public $id;

    /**
     * Info on the actual opt in
     *
     * @var \Ticketmatic\Model\ContactOptInInfo
     */
    public $info;

    /**
     * ID of the optin
     *
     * @var int
     */
    public $optinid;

    /**
     * Status of the opt-in. Possible values are `Unknown (7601)`, `Opted In` (7602)
     * and `Opted Out` (7603)
     *
     * @var int
     */
    public $status;

    /**
     * Created timestamp
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack ContactOptIn from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ContactOptIn
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ContactOptIn(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "info" => isset($obj->info) ? ContactOptInInfo::fromJson($obj->info) : null,
            "optinid" => isset($obj->optinid) ? $obj->optinid : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize ContactOptIn to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->info)) {
            $result["info"] = $this->info;
        }
        if (!is_null($this->optinid)) {
            $result["optinid"] = intval($this->optinid);
        }
        if (!is_null($this->status)) {
            $result["status"] = intval($this->status);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
