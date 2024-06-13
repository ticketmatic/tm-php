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
 * Info for requesting field definition data for one or more items.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/FielddefinitionsDataRequest).
 */
class FielddefinitionsDataRequest implements \jsonSerializable
{
    /**
     * Create a new FielddefinitionsDataRequest
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Type id
     *
     * @var int
     */
    public $typeid;

    /**
     * Keys for field definitions to retrieve
     *
     * @var string[]
     */
    public $fielddefinitions;

    /**
     * Item ids
     *
     * @var int[]
     */
    public $ids;

    /**
     * Unpack FielddefinitionsDataRequest from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\FielddefinitionsDataRequest
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new FielddefinitionsDataRequest(array(
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "fielddefinitions" => isset($obj->fielddefinitions) ? $obj->fielddefinitions : null,
            "ids" => isset($obj->ids) ? $obj->ids : null,
        ));
    }

    /**
     * Serialize FielddefinitionsDataRequest to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->fielddefinitions)) {
            $result["fielddefinitions"] = $this->fielddefinitions;
        }
        if (!is_null($this->ids)) {
            $result["ids"] = $this->ids;
        }

        return $result;
    }
}
