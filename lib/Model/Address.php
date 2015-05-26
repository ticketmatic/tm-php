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
 * Address, used for physical deliveries and contact details.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Address).
 */
class Address implements \jsonSerializable
{
    /**
     * Create a new Address
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Address ID
     *
     * Note: Only available when used for a contact
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) address.
     *
     * @var int
     */
    public $id;

    /**
     * Contact this address belongs to
     *
     * Note: Only available when used for a contact
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) address.
     *
     * @var int
     */
    public $customerid;

    /**
     * Addressee
     *
     * Note: Only available when used as an order
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Order) deliver address.
     *
     * @var string
     */
    public $addressee;

    /**
     * ISO 3166-1 alpha-2 country code
     * (http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
     *
     * @var string
     */
    public $countrycode;

    /**
     * Country name (based on `typeid`, returned as a convenience).
     *
     * Note: Only available when used for a contact
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) address.
     *
     * @var string
     */
    public $country;

    /**
     * Zip code
     *
     * @var string
     */
    public $zip;

    /**
     * City
     *
     * @var string
     */
    public $city;

    /**
     * Street field 1 (typically the street name)
     *
     * @var string
     */
    public $street1;

    /**
     * Street field 2 (typically the number)
     *
     * @var string
     */
    public $street2;

    /**
     * Street field 3 (sometimes used for box numbers or suffixes)
     *
     * @var string
     */
    public $street3;

    /**
     * Street field 4 (rarely used)
     *
     * @var string
     */
    public $street4;

    /**
     * Address type ID
     *
     * Note: Only available when used for a contact
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) address.
     *
     * @var int
     */
    public $typeid;

    /**
     * Address type (based on `typeid`, returned as a convenience).
     *
     * Note: Only available when used for a contact
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) address.
     *
     * @var string
     */
    public $type;

    /**
     * Unpack Address from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Address
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Address(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "addressee" => isset($obj->addressee) ? $obj->addressee : null,
            "countrycode" => isset($obj->countrycode) ? $obj->countrycode : null,
            "country" => isset($obj->country) ? $obj->country : null,
            "zip" => isset($obj->zip) ? $obj->zip : null,
            "city" => isset($obj->city) ? $obj->city : null,
            "street1" => isset($obj->street1) ? $obj->street1 : null,
            "street2" => isset($obj->street2) ? $obj->street2 : null,
            "street3" => isset($obj->street3) ? $obj->street3 : null,
            "street4" => isset($obj->street4) ? $obj->street4 : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "type" => isset($obj->type) ? $obj->type : null,
        ));
    }

    /**
     * Serialize Address to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
        }
        if (!is_null($this->addressee)) {
            $result["addressee"] = strval($this->addressee);
        }
        if (!is_null($this->countrycode)) {
            $result["countrycode"] = strval($this->countrycode);
        }
        if (!is_null($this->country)) {
            $result["country"] = strval($this->country);
        }
        if (!is_null($this->zip)) {
            $result["zip"] = strval($this->zip);
        }
        if (!is_null($this->city)) {
            $result["city"] = strval($this->city);
        }
        if (!is_null($this->street1)) {
            $result["street1"] = strval($this->street1);
        }
        if (!is_null($this->street2)) {
            $result["street2"] = strval($this->street2);
        }
        if (!is_null($this->street3)) {
            $result["street3"] = strval($this->street3);
        }
        if (!is_null($this->street4)) {
            $result["street4"] = strval($this->street4);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->type)) {
            $result["type"] = strval($this->type);
        }

        return $result;
    }
}
