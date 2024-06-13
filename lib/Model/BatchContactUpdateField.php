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
 * Field to update on contact
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/BatchContactUpdateField).
 */
class BatchContactUpdateField implements \jsonSerializable
{
    /**
     * Create a new BatchContactUpdateField
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The name of the field, can either be a custom field or one of the following
     * fixed fields (`customertitleid`, `languagecode`).
     *
     * @var string
     */
    public $key;

    /**
     * The type of update that needs to be done on the field. Can either be `set
     * (default)`, `add` or `remove` when used in combination with multi value fields.
     *
     * @var string
     */
    public $updatetype;

    /**
     * The value of the field
     *
     * @var object
     */
    public $value;

    /**
     * Unpack BatchContactUpdateField from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\BatchContactUpdateField
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new BatchContactUpdateField(array(
            "key" => isset($obj->key) ? $obj->key : null,
            "updatetype" => isset($obj->updatetype) ? $obj->updatetype : null,
            "value" => isset($obj->value) ? $obj->value : null,
        ));
    }

    /**
     * Serialize BatchContactUpdateField to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->key)) {
            $result["key"] = strval($this->key);
        }
        if (!is_null($this->updatetype)) {
            $result["updatetype"] = strval($this->updatetype);
        }
        if (!is_null($this->value)) {
            $result["value"] = $this->value;
        }

        return $result;
    }
}
