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
 * Account information
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AccountInfo).
 */
class AccountInfo implements \jsonSerializable
{
    /**
     * Create a new AccountInfo
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Account ID
     *
     * @var int
     */
    public $id;

    /**
     * Account Name
     *
     * @var string
     */
    public $name;

    /**
     * Account address
     *
     * @var string
     */
    public $address;

    /**
     * Link to the account image
     *
     * @var string
     */
    public $imageurl;

    /**
     * Latitude
     *
     * @var float
     */
    public $lat;

    /**
     * Link to the account logo
     *
     * @var string
     */
    public $logourl;

    /**
     * Longitude
     *
     * @var float
     */
    public $long;

    /**
     * Account short name
     *
     * @var string
     */
    public $shortname;

    /**
     * Account website
     *
     * @var string
     */
    public $url;

    /**
     * Unpack AccountInfo from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AccountInfo
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AccountInfo(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "address" => isset($obj->address) ? $obj->address : null,
            "imageurl" => isset($obj->imageurl) ? $obj->imageurl : null,
            "lat" => isset($obj->lat) ? $obj->lat : null,
            "logourl" => isset($obj->logourl) ? $obj->logourl : null,
            "long" => isset($obj->long) ? $obj->long : null,
            "shortname" => isset($obj->shortname) ? $obj->shortname : null,
            "url" => isset($obj->url) ? $obj->url : null,
        ));
    }

    /**
     * Serialize AccountInfo to JSON.
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
        if (!is_null($this->address)) {
            $result["address"] = strval($this->address);
        }
        if (!is_null($this->imageurl)) {
            $result["imageurl"] = strval($this->imageurl);
        }
        if (!is_null($this->lat)) {
            $result["lat"] = floatval($this->lat);
        }
        if (!is_null($this->logourl)) {
            $result["logourl"] = strval($this->logourl);
        }
        if (!is_null($this->long)) {
            $result["long"] = floatval($this->long);
        }
        if (!is_null($this->shortname)) {
            $result["shortname"] = strval($this->shortname);
        }
        if (!is_null($this->url)) {
            $result["url"] = strval($this->url);
        }

        return $result;
    }
}
