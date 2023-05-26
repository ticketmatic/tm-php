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
 * A single order mail template.
 *
 * More info: see the get operation
 * (api/settings/communicationanddesign/ordermails/get) and the order mail
 * templates endpoint (api/settings/communicationanddesign/ordermails).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderMailTemplate).
 */
class OrderMailTemplate implements \jsonSerializable
{
    /**
     * Create a new OrderMailTemplate
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
     * **Note:** Ignored when creating a new order mail template.
     *
     * **Note:** Ignored when updating an existing order mail template.
     *
     * @var int
     */
    public $id;

    /**
     * The type of this order mail template, defines where this template is used.
     * The available values for this field can be found on the order mail template
     * overview (api/settings/communicationanddesign/ordermails) page.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the order mail template
     *
     * @var string
     */
    public $name;

    /**
     * Message body
     *
     * **Note:** Not set when retrieving a list of order mail templates.
     *
     * @var string
     */
    public $body;

    /**
     * Subject line for the order mail template
     *
     * **Note:** Not set when retrieving a list of order mail templates.
     *
     * @var string
     */
    public $subject;

    /**
     * A map of language codes to gettext .po files
     * (http://en.wikipedia.org/wiki/Gettext). More info can be found on the order mail
     * template overview (api/settings/communicationanddesign/ordermails) page.
     *
     * **Note:** Not set when retrieving a list of order mail templates.
     *
     * @var string[]
     */
    public $translations;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new order mail template.
     *
     * **Note:** Ignored when updating an existing order mail template.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new order mail template.
     *
     * **Note:** Ignored when updating an existing order mail template.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new order mail template.
     *
     * **Note:** Ignored when updating an existing order mail template.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack OrderMailTemplate from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderMailTemplate(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "body" => isset($obj->body) ? $obj->body : null,
            "subject" => isset($obj->subject) ? $obj->subject : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize OrderMailTemplate to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->body)) {
            $result["body"] = strval($this->body);
        }
        if (!is_null($this->subject)) {
            $result["subject"] = strval($this->subject);
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
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
