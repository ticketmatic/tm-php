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
 * See contact (https://apps.ticketmatic.com/#/knowledgebase/api/types/Contact) for
 * more information.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Phonenumber).
 */
class Phonenumber implements \jsonSerializable
{
    /**
     * Create a new Phonenumber
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
     * Phone number
     *
     * @var string
     */
    public $number;

    /**
     * Phone number type ID
     *
     * @var int
     */
    public $typeid;

    /**
     * Phone number type (based on `typeid`, returned as a convenience)
     *
     * @var string
     */
    public $type;

    /**
     * Unpack Phonenumber from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Phonenumber
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Phonenumber(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "number" => isset($obj->number) ? $obj->number : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "type" => isset($obj->type) ? $obj->type : null,
        ));
    }

    /**
     * Serialize Phonenumber to JSON.
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
        if (!is_null($this->number)) {
            $result["number"] = strval($this->number);
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
