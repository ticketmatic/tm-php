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
 * A set of fields to create a order mail template. More info: see the create
 * operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ordermails/create)
 * and the order mail templates endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ordermails).
 */
class CreateOrderMailTemplate implements \jsonSerializable
{
    /**
     * Create a new CreateOrderMailTemplate
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $typeid;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $body;

    /**
     * @var string[]
     */
    public $translations;

    /**
     * Unpack CreateOrderMailTemplate from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CreateOrderMailTemplate
     */
    public static function fromJson($obj) {
        return new CreateOrderMailTemplate(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "subject" => $obj->subject,
            "body" => $obj->body,
            "translations" => Json::unpackArray("string", $obj->translations),
        ));
    }

    /**
     * Serialize CreateOrderMailTemplate to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->subject)) {
                $result["subject"] = strval($this->subject);
            }
            if (!is_null($this->body)) {
                $result["body"] = strval($this->body);
            }
            if (!is_null($this->translations)) {
                $result["translations"] = $this->translations;
            }

        }
        return $result;
    }
}
