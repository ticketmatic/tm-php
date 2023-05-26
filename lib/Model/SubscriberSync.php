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
 * A subscriber record to sync state back to Ticketmatic
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SubscriberSync).
 */
class SubscriberSync implements \jsonSerializable
{
    /**
     * Create a new SubscriberSync
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Subscriber e-mail
     *
     * @var string
     */
    public $email;

    /**
     * Subscriber first name
     *
     * @var string
     */
    public $firstname;

    /**
     * Subscriber last name
     *
     * @var string
     */
    public $lastname;

    /**
     * Previous value of the `email` field, to indicate a changed e-mail address.
     *
     * Used to find the correct contact. The normal `email` field will be used when
     * this field is ommitted or empty.
     *
     * @var string
     */
    public $oldemail;

    /**
     * Whether or not the subscriber is still subscribed
     *
     * @var bool
     */
    public $subscribed;

    /**
     * Unpack SubscriberSync from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SubscriberSync
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SubscriberSync(array(
            "email" => isset($obj->email) ? $obj->email : null,
            "firstname" => isset($obj->firstname) ? $obj->firstname : null,
            "lastname" => isset($obj->lastname) ? $obj->lastname : null,
            "oldemail" => isset($obj->oldemail) ? $obj->oldemail : null,
            "subscribed" => isset($obj->subscribed) ? $obj->subscribed : null,
        ));
    }

    /**
     * Serialize SubscriberSync to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->email)) {
            $result["email"] = strval($this->email);
        }
        if (!is_null($this->firstname)) {
            $result["firstname"] = strval($this->firstname);
        }
        if (!is_null($this->lastname)) {
            $result["lastname"] = strval($this->lastname);
        }
        if (!is_null($this->oldemail)) {
            $result["oldemail"] = strval($this->oldemail);
        }
        if (!is_null($this->subscribed)) {
            $result["subscribed"] = (bool)$this->subscribed;
        }

        return $result;
    }
}
