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
 * A single contact title.
 *
 * More info: see the get operation (api/settings/system/contacttitles/get) and the
 * contact titles endpoint (api/settings/system/contacttitles).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ContactTitle).
 */
class ContactTitle implements \jsonSerializable
{
    /**
     * Create a new ContactTitle
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
     * **Note:** Ignored when creating a new contact title.
     *
     * **Note:** Ignored when updating an existing contact title.
     *
     * @var int
     */
    public $id;

    /**
     * Title name
     *
     * @var string
     */
    public $name;

    /**
     * Restricts this title from showing up on the websales pages
     *
     * @var bool
     */
    public $isinternal;

    /**
     * Language for this title
     *
     * @var string
     */
    public $languagecode;

    /**
     * Gender associated with this title
     *
     * @var string
     */
    public $sex;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new contact title.
     *
     * **Note:** Ignored when updating an existing contact title.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new contact title.
     *
     * **Note:** Ignored when updating an existing contact title.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new contact title.
     *
     * **Note:** Ignored when updating an existing contact title.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack ContactTitle from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ContactTitle
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ContactTitle(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "isinternal" => isset($obj->isinternal) ? $obj->isinternal : null,
            "languagecode" => isset($obj->languagecode) ? $obj->languagecode : null,
            "sex" => isset($obj->sex) ? $obj->sex : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize ContactTitle to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->isinternal)) {
            $result["isinternal"] = (bool)$this->isinternal;
        }
        if (!is_null($this->languagecode)) {
            $result["languagecode"] = strval($this->languagecode);
        }
        if (!is_null($this->sex)) {
            $result["sex"] = strval($this->sex);
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

        return $result;
    }
}
