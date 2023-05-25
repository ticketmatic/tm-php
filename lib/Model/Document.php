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
 * A single document.
 *
 * More info: see the get operation
 * (api/settings/communicationanddesign/documents/get) and the documents endpoint
 * (api/settings/communicationanddesign/documents).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Document).
 */
class Document implements \jsonSerializable
{
    /**
     * Create a new Document
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
     * **Note:** Ignored when creating a new document.
     *
     * **Note:** Ignored when updating an existing document.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing document.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the document
     *
     * @var string
     */
    public $name;

    /**
     * Css content for the document template
     *
     * **Note:** Not set when retrieving a list of documents.
     *
     * @var string
     */
    public $css;

    /**
     * Description of the document
     *
     * @var string
     */
    public $description;

    /**
     * Translations for the document template
     *
     * @var bool
     */
    public $enabled;

    /**
     * HTML content for the document template
     *
     * **Note:** Not set when retrieving a list of documents.
     *
     * @var string
     */
    public $htmltemplate;

    /**
     * Key-value array of options. Can contain: nbrperpage
     *
     * **Note:** Not set when retrieving a list of documents.
     *
     * @var \Ticketmatic\Model\DocumentOptions
     */
    public $options;

    /**
     * Translations for the document template
     *
     * **Note:** Not set when retrieving a list of documents.
     *
     * @var string[]
     */
    public $translations;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new document.
     *
     * **Note:** Ignored when updating an existing document.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new document.
     *
     * **Note:** Ignored when updating an existing document.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack Document from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Document
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Document(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "css" => isset($obj->css) ? $obj->css : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "enabled" => isset($obj->enabled) ? $obj->enabled : null,
            "htmltemplate" => isset($obj->htmltemplate) ? $obj->htmltemplate : null,
            "options" => isset($obj->options) ? DocumentOptions::fromJson($obj->options) : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize Document to JSON.
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
        if (!is_null($this->css)) {
            $result["css"] = strval($this->css);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->enabled)) {
            $result["enabled"] = (bool)$this->enabled;
        }
        if (!is_null($this->htmltemplate)) {
            $result["htmltemplate"] = strval($this->htmltemplate);
        }
        if (!is_null($this->options)) {
            $result["options"] = $this->options;
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
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
