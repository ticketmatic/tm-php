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
 * Batch operations performed on events
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/BatchEventOperation).
 */
class BatchEventOperation implements \jsonSerializable
{
    /**
     * Create a new BatchEventOperation
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Restrict operation to supplied IDs, if these ids are not specified **all**
     * events are updated.
     *
     * @var int[]
     */
    public $ids;

    /**
     * Operation to perform, possible values are: `duplicate` , `publish`, `delete`,
     * `close`, `update`, `redraft`, `reopen`
     *
     * @var string
     */
    public $operation;

    /**
     * Operation-specific parameters
     *
     * @var \Ticketmatic\Model\BatchEventParameters
     */
    public $parameters;

    /**
     * Unpack BatchEventOperation from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\BatchEventOperation
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new BatchEventOperation(array(
            "ids" => isset($obj->ids) ? $obj->ids : null,
            "operation" => isset($obj->operation) ? $obj->operation : null,
            "parameters" => isset($obj->parameters) ? BatchEventParameters::fromJson($obj->parameters) : null,
        ));
    }

    /**
     * Serialize BatchEventOperation to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->ids)) {
            $result["ids"] = $this->ids;
        }
        if (!is_null($this->operation)) {
            $result["operation"] = strval($this->operation);
        }
        if (!is_null($this->parameters)) {
            $result["parameters"] = $this->parameters;
        }

        return $result;
    }
}
