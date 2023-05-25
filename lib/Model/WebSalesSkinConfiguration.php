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
 * Configuration settings and parameters for a web sales skin
 * (api/types/WebSalesSkin).
 *
 * ## Page titles
 *
 * The `title` field contains a template for the page title. The same variables as
 * in the HTML of the skin itself can be used.
 *
 * Check the web sales skin setup guide (tickets/configure_ticket_sales/webskin)
 * for more information.
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
     * Asset path to favicon image.
     *
     * @var string
     */
    public $favicon;

    /**
     * Deprecated, use Google Tag Manager.
     *
     * @var string
     */
    public $googleanalyticsid;

    /**
     * Google Tag Manager ID. Can be left blank.
     *
     * @var string
     */
    public $googletagmanagerid;

    /**
     * Page title
     *
     * @var string
     */
    public $title;

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
            "favicon" => isset($obj->favicon) ? $obj->favicon : null,
            "googleanalyticsid" => isset($obj->googleanalyticsid) ? $obj->googleanalyticsid : null,
            "googletagmanagerid" => isset($obj->googletagmanagerid) ? $obj->googletagmanagerid : null,
            "title" => isset($obj->title) ? $obj->title : null,
        ));
    }

    /**
     * Serialize WebSalesSkinConfiguration to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->favicon)) {
            $result["favicon"] = strval($this->favicon);
        }
        if (!is_null($this->googleanalyticsid)) {
            $result["googleanalyticsid"] = strval($this->googleanalyticsid);
        }
        if (!is_null($this->googletagmanagerid)) {
            $result["googletagmanagerid"] = strval($this->googletagmanagerid);
        }
        if (!is_null($this->title)) {
            $result["title"] = strval($this->title);
        }

        return $result;
    }
}
