<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * A single web sales skin. More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins/get).
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
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $html;

    /**
     * @var string
     */
    public $css;

    /**
     * @var string[]
     */
    public $translations;

    /**
     * @var \Ticketmatic\Model\WebskinConfiguration
     */
    public $configuration;

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
     * Convert WebSalesSkin to UpdateWebSalesSkin
     *
     * @return \Ticketmatic\Model\UpdateWebSalesSkin
     */
    public function toUpdate() {
        $result = new UpdateWebSalesSkin();
        $result->name = $this->name;
        $result->html = $this->html;
        $result->css = $this->css;
        $result->translations = $this->translations;
        $result->configuration = $this->configuration;
        return $result;
    }

    /**
     * Unpack WebSalesSkin from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\WebSalesSkin
     */
    public static function fromJson($obj) {
        return new WebSalesSkin(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "html" => $obj->html,
            "css" => $obj->css,
            "translations" => Json::unpackArray("string", $obj->translations),
            "configuration" => WebskinConfiguration::fromJson($obj->configuration),
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
        ));
    }

    /**
     * Serialize WebSalesSkin to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->html)) {
                $result["html"] = strval($this->html);
            }
            if (!is_null($this->css)) {
                $result["css"] = strval($this->css);
            }
            if (!is_null($this->translations)) {
                $result["translations"] = $this->translations;
            }
            if (!is_null($this->configuration)) {
                $result["configuration"] = $this->configuration;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }

        }
        return $result;
    }
}
