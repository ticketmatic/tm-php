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
 * Configuration settings and parameters for a web sales skin
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/WebSalesSkin).
 *
 * ## Page titles
 *
 * The `title` field contains a template for the page title. The same variables as
 * in the HTML of the skin itself can be used.
 *
 * Check the web sales skin setup guide
 * (https://apps.ticketmatic.com/#/knowledgebase/designer_webskin) for more
 * information.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/WebSalesSkinConfiguration).
 */
class WebSalesSkinConfiguration implements \jsonSerializable
{
    /**
     * Create a new WebSalesSkinConfiguration
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Page title
     *
     * @var string
     */
    public $title;

    /**
     * Asset path to favicon image.
     *
     * @var string
     */
    public $favicon;

    /**
     * Facebook app ID to use for Facebook authentication.
     *
     * The default Ticketmatic Facebook app will be used if you leave this field blank
     *
     * @var string
     */
    public $fbappid;

    /**
     * Google Analytics tracking ID. Can be left blank.
     *
     * @var string
     */
    public $googleanalyticsid;

    /**
     * Unpack WebSalesSkinConfiguration from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\WebSalesSkinConfiguration
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new WebSalesSkinConfiguration(array(
            "title" => isset($obj->title) ? $obj->title : null,
            "favicon" => isset($obj->favicon) ? $obj->favicon : null,
            "fbappid" => isset($obj->fbappid) ? $obj->fbappid : null,
            "googleanalyticsid" => isset($obj->googleanalyticsid) ? $obj->googleanalyticsid : null,
        ));
    }

    /**
     * Serialize WebSalesSkinConfiguration to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->title)) {
            $result["title"] = strval($this->title);
        }
        if (!is_null($this->favicon)) {
            $result["favicon"] = strval($this->favicon);
        }
        if (!is_null($this->fbappid)) {
            $result["fbappid"] = strval($this->fbappid);
        }
        if (!is_null($this->googleanalyticsid)) {
            $result["googleanalyticsid"] = strval($this->googleanalyticsid);
        }

        return $result;
    }
}
