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
 * A single contact.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/contacts/get) and the contacts
 * endpoint (https://apps.ticketmatic.com/#/knowledgebase/api/contacts).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact).
 */
class Contact implements \jsonSerializable
{
    /**
     * Create a new Contact
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Contact ID
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var int
     */
    public $id;

    /**
     * E-mail address
     *
     * @var string
     */
    public $email;

    /**
     * Customer title ID (also determines the gender of the contact)
     *
     * @var int
     */
    public $customertitleid;

    /**
     * First name
     *
     * @var string
     */
    public $firstname;

    /**
     * Middle name
     *
     * @var string
     */
    public $middlename;

    /**
     * Last name
     *
     * @var string
     */
    public $lastname;

    /**
     * Language (ISO 639-1 code (http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes))
     *
     * @var string
     */
    public $languagecode;

    /**
     * Sex
     *
     * @var string
     */
    public $sex;

    /**
     * Birth date
     *
     * @var \DateTime
     */
    public $birthdate;

    /**
     * Company
     *
     * @var string
     */
    public $company;

    /**
     * Job function
     *
     * @var string
     */
    public $organizationfunction;

    /**
     * Addresses
     *
     * @var \Ticketmatic\Model\Address[]
     */
    public $addresses;

    /**
     * VAT Number (for organizations)
     *
     * @var string
     */
    public $vatnumber;

    /**
     * Phone numbers
     *
     * @var \Ticketmatic\Model\Phonenumber[]
     */
    public $phonenumbers;

    /**
     * Relation type IDs
     *
     * @var int[]
     */
    public $relationtypes;

    /**
     * Whether or not this contact is subscribed in the e-mail marketing integration
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var bool
     */
    public $subscribed;

    /**
     * Contact status
     *
     * Possible values:
     *
     * * **deleted**: Contact has been deleted
     *
     * * **incomplete**: Contact misses crucial account information
     *
     * * **(blank)**: Normal contact
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var string
     */
    public $status;

    /**
     * Account type.
     *
     * Indicates the authentication type supported for this contact (used when
     * authentication is enabled in web sales).
     *
     * Possible values:
     *
     * * **0**: No authentication
     *
     * * **1901**: Password authentication
     *
     * * **1902**: Facebook
     *
     * * **1903**: Google
     *
     * * **1904**: Twitter
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var int
     */
    public $account_type;

    /**
     * Whether or not this contact has been deleted
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var bool
     */
    public $isdeleted;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new contact.
     *
     * **Note:** Ignored when updating an existing contact.
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
     * Unpack Contact from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Contact
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new Contact(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "email" => isset($obj->email) ? $obj->email : null,
            "customertitleid" => isset($obj->customertitleid) ? $obj->customertitleid : null,
            "firstname" => isset($obj->firstname) ? $obj->firstname : null,
            "middlename" => isset($obj->middlename) ? $obj->middlename : null,
            "lastname" => isset($obj->lastname) ? $obj->lastname : null,
            "languagecode" => isset($obj->languagecode) ? $obj->languagecode : null,
            "sex" => isset($obj->sex) ? $obj->sex : null,
            "birthdate" => isset($obj->birthdate) ? Json::unpackTimestamp($obj->birthdate) : null,
            "company" => isset($obj->company) ? $obj->company : null,
            "organizationfunction" => isset($obj->organizationfunction) ? $obj->organizationfunction : null,
            "addresses" => isset($obj->addresses) ? Json::unpackArray("Address", $obj->addresses) : null,
            "vatnumber" => isset($obj->vatnumber) ? $obj->vatnumber : null,
            "phonenumbers" => isset($obj->phonenumbers) ? Json::unpackArray("Phonenumber", $obj->phonenumbers) : null,
            "relationtypes" => isset($obj->relationtypes) ? $obj->relationtypes : null,
            "subscribed" => isset($obj->subscribed) ? $obj->subscribed : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "account_type" => isset($obj->account_type) ? $obj->account_type : null,
            "isdeleted" => isset($obj->isdeleted) ? $obj->isdeleted : null,
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
     * Serialize Contact to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->email)) {
            $result["email"] = strval($this->email);
        }
        if (!is_null($this->customertitleid)) {
            $result["customertitleid"] = intval($this->customertitleid);
        }
        if (!is_null($this->firstname)) {
            $result["firstname"] = strval($this->firstname);
        }
        if (!is_null($this->middlename)) {
            $result["middlename"] = strval($this->middlename);
        }
        if (!is_null($this->lastname)) {
            $result["lastname"] = strval($this->lastname);
        }
        if (!is_null($this->languagecode)) {
            $result["languagecode"] = strval($this->languagecode);
        }
        if (!is_null($this->sex)) {
            $result["sex"] = strval($this->sex);
        }
        if (!is_null($this->birthdate)) {
            $result["birthdate"] = Json::packTimestamp($this->birthdate);
        }
        if (!is_null($this->company)) {
            $result["company"] = strval($this->company);
        }
        if (!is_null($this->organizationfunction)) {
            $result["organizationfunction"] = strval($this->organizationfunction);
        }
        if (!is_null($this->addresses)) {
            $result["addresses"] = $this->addresses;
        }
        if (!is_null($this->vatnumber)) {
            $result["vatnumber"] = strval($this->vatnumber);
        }
        if (!is_null($this->phonenumbers)) {
            $result["phonenumbers"] = $this->phonenumbers;
        }
        if (!is_null($this->relationtypes)) {
            $result["relationtypes"] = $this->relationtypes;
        }
        if (!is_null($this->subscribed)) {
            $result["subscribed"] = (bool)$this->subscribed;
        }
        if (!is_null($this->status)) {
            $result["status"] = strval($this->status);
        }
        if (!is_null($this->account_type)) {
            $result["account_type"] = intval($this->account_type);
        }
        if (!is_null($this->isdeleted)) {
            $result["isdeleted"] = (bool)$this->isdeleted;
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
