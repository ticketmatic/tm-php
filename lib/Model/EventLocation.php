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
 * A single event location.
 *
 * More info: see the get operation (api/settings/events/eventlocations/get) and
 * the event locations endpoint (api/settings/events/eventlocations).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventLocation).
 */
class EventLocation implements \jsonSerializable
{
    /**
     * Create a new EventLocation
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
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the location
     *
     * @var string
     */
    public $name;

    /**
     * City
     *
     * @var string
     */
    public $city;

    /**
     * Country code. Should be an ISO 3166-1 alpha-2
     * (http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) two-letter code.
     *
     * @var string
     */
    public $countrycode;

    /**
     * Geocode status for the address of this location.
     *
     * @var int
     */
    public $geostatus;

    /**
     * Practical info on the event location (route description, public transport,
     * parking,...).
     *
     * @var string
     */
    public $info;

    /**
     * Lat coordinate for the event location
     *
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var float
     */
    public $lat;

    /**
     * Long coordinate for the event location
     *
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var float
     */
    public $long;

    /**
     * State
     *
     * @var string
     */
    public $state;

    /**
     * Street name
     *
     * @var string
     */
    public $street1;

    /**
     * Nr. + Box
     *
     * @var string
     */
    public $street2;

    /**
     * Zipcode
     *
     * @var string
     */
    public $zip;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new event location.
     *
     * **Note:** Ignored when updating an existing event location.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

    /**
     * Unpack EventLocation from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventLocation
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new EventLocation(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "city" => isset($obj->city) ? $obj->city : null,
            "countrycode" => isset($obj->countrycode) ? $obj->countrycode : null,
            "geostatus" => isset($obj->geostatus) ? $obj->geostatus : null,
            "info" => isset($obj->info) ? $obj->info : null,
            "lat" => isset($obj->lat) ? $obj->lat : null,
            "long" => isset($obj->long) ? $obj->long : null,
            "state" => isset($obj->state) ? $obj->state : null,
            "street1" => isset($obj->street1) ? $obj->street1 : null,
            "street2" => isset($obj->street2) ? $obj->street2 : null,
            "zip" => isset($obj->zip) ? $obj->zip : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));

        $result->custom_fields = array();
        foreach ($obj as $key => $value) {
            if (substr($key, 0, 2) === "c_") {
                $key = substr($key, 2);
                $result->custom_fields[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Serialize EventLocation to JSON.
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
        if (!is_null($this->city)) {
            $result["city"] = strval($this->city);
        }
        if (!is_null($this->countrycode)) {
            $result["countrycode"] = strval($this->countrycode);
        }
        if (!is_null($this->geostatus)) {
            $result["geostatus"] = intval($this->geostatus);
        }
        if (!is_null($this->info)) {
            $result["info"] = strval($this->info);
        }
        if (!is_null($this->lat)) {
            $result["lat"] = floatval($this->lat);
        }
        if (!is_null($this->long)) {
            $result["long"] = floatval($this->long);
        }
        if (!is_null($this->state)) {
            $result["state"] = strval($this->state);
        }
        if (!is_null($this->street1)) {
            $result["street1"] = strval($this->street1);
        }
        if (!is_null($this->street2)) {
            $result["street2"] = strval($this->street2);
        }
        if (!is_null($this->zip)) {
            $result["zip"] = strval($this->zip);
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


        if (is_array($this->custom_fields)) {
            foreach ($this->custom_fields as $key => $value) {
                $result["c_" . $key] = $value;
            }
        }

        return $result;
    }
}
