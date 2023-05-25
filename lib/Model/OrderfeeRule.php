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
 * More info about order fees can be found here
 * (api/settings/ticketsales/orderfees).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderfeeRule).
 */
class OrderfeeRule implements \jsonSerializable
{
    /**
     * Create a new OrderfeeRule
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * This is required if the order fee type is set to automatic. It is a set of rules
     * that define the order fee.
     *
     * @var \Ticketmatic\Model\OrderfeeAutoRule[]
     */
    public $auto;

    /**
     * This can be set if the order fee type is set to script. It allows adding extra
     * information to the script environment.
     *
     * @var \Ticketmatic\Model\OrderfeeScriptContext[]
     */
    public $context;

    /**
     * This is required if the order fee type is set to script. The javascript needs to
     * return a value.
     *
     * @var string
     */
    public $script;

    /**
     * Unpack OrderfeeRule from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderfeeRule
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderfeeRule(array(
            "auto" => isset($obj->auto) ? Json::unpackArray("OrderfeeAutoRule", $obj->auto) : null,
            "context" => isset($obj->context) ? Json::unpackArray("OrderfeeScriptContext", $obj->context) : null,
            "script" => isset($obj->script) ? $obj->script : null,
        ));
    }

    /**
     * Serialize OrderfeeRule to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->auto)) {
            $result["auto"] = $this->auto;
        }
        if (!is_null($this->context)) {
            $result["context"] = $this->context;
        }
        if (!is_null($this->script)) {
            $result["script"] = strval($this->script);
        }

        return $result;
    }
}
