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
    public $image;

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
    public $logo;

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
            "image" => isset($obj->image) ? $obj->image : null,
            "lat" => isset($obj->lat) ? $obj->lat : null,
            "logo" => isset($obj->logo) ? $obj->logo : null,
            "long" => isset($obj->long) ? $obj->long : null,
            "shortname" => isset($obj->shortname) ? $obj->shortname : null,
            "url" => isset($obj->url) ? $obj->url : null,
        ));
    }

    /**
     * Serialize AccountInfo to JSON.
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
        if (!is_null($this->address)) {
            $result["address"] = strval($this->address);
        }
        if (!is_null($this->image)) {
            $result["image"] = strval($this->image);
        }
        if (!is_null($this->lat)) {
            $result["lat"] = floatval($this->lat);
        }
        if (!is_null($this->logo)) {
            $result["logo"] = strval($this->logo);
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
