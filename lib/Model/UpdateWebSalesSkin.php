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
 * A set of fields to update a web sales skin.
 *
 * More info: see the update operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins/update)
 * and the web sales skins endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/UpdateWebSalesSkin).
 */
class UpdateWebSalesSkin implements \jsonSerializable
{
    /**
     * Create a new UpdateWebSalesSkin
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Name of the sales channel
     *
     * @var string
     */
    public $name;

    /**
     * HTML template of the skin. See the web skin setup guide
     * (https://apps.ticketmatic.com/#/knowledgebase/designer_webskin) for more
     * information.
     *
     * @var string
     */
    public $html;

    /**
     * CSS style rules. Should always include the `style` import.
     *
     * @var string
     */
    public $css;

    /**
     * A map of language codes to gettext .po files
     * (http://en.wikipedia.org/wiki/Gettext). More info can be found on the web skin
     * overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins)
     * page
     *
     * @var string[]
     */
    public $translations;

    /**
     * Skin configuration, described on the web skin overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins)
     * page
     *
     * @var \Ticketmatic\Model\WebskinConfiguration
     */
    public $configuration;

    /**
     * Unpack UpdateWebSalesSkin from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\UpdateWebSalesSkin
     */
    public static function fromJson($obj) {
        return new UpdateWebSalesSkin(array(
            "name" => $obj->name,
            "html" => $obj->html,
            "css" => $obj->css,
            "translations" => Json::unpackArray("string", $obj->translations),
            "configuration" => WebskinConfiguration::fromJson($obj->configuration),
        ));
    }

    /**
     * Serialize UpdateWebSalesSkin to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
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

        }
        return $result;
    }
}
