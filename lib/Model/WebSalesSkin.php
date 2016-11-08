<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * A single web sales skin.
 *
 * More info: see the get operation
 * (api/settings/communicationanddesign/webskins/get) and the web sales skins
 * endpoint (api/settings/communicationanddesign/webskins).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/WebSalesSkin).
 */
class WebSalesSkin implements \jsonSerializable
{
    /**
     * Create a new WebSalesSkin
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
     * **Note:** Ignored when creating a new web sales skin.
     *
     * **Note:** Ignored when updating an existing web sales skin.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the web sales skin
     *
     * @var string
     */
    public $name;

    /**
     * Skin configuration.
     *
     * See the WebSalesSkinConfiguration reference
     * (api/types/WebSalesSkinConfiguration) for an overview of all possible options.
     *
     * **Note:** Not set when retrieving a list of web sales skins.
     *
     * @var \Ticketmatic\Model\WebSalesSkinConfiguration
     */
    public $configuration;

    /**
     * CSS style rules. Should always include the `style` import.
     *
     * **Note:** Not set when retrieving a list of web sales skins.
     *
     * @var string
     */
    public $css;

    /**
     * HTML template of the skin. See the web skin setup guide
     * (tickets/configure_ticket_sales/webskin) for more information.
     *
     * **Note:** Not set when retrieving a list of web sales skins.
     *
     * @var string
     */
    public $html;

    /**
     * A map of language codes to gettext .po files
     * (http://en.wikipedia.org/wiki/Gettext). More info can be found on the web skin
     * overview (api/settings/communicationanddesign/webskins) page.
     *
     * **Note:** Not set when retrieving a list of web sales skins.
     *
     * @var string[]
     */
    public $translations;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new web sales skin.
     *
     * **Note:** Ignored when updating an existing web sales skin.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new web sales skin.
     *
     * **Note:** Ignored when updating an existing web sales skin.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack WebSalesSkin from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\WebSalesSkin
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new WebSalesSkin(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "configuration" => isset($obj->configuration) ? WebSalesSkinConfiguration::fromJson($obj->configuration) : null,
            "css" => isset($obj->css) ? $obj->css : null,
            "html" => isset($obj->html) ? $obj->html : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize WebSalesSkin to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->configuration)) {
            $result["configuration"] = $this->configuration;
        }
        if (!is_null($this->css)) {
            $result["css"] = strval($this->css);
        }
        if (!is_null($this->html)) {
            $result["html"] = strval($this->html);
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
