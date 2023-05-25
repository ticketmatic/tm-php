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
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderfeeScriptContext).
 */
class OrderfeeScriptContext implements \jsonSerializable
{
    /**
     * Create a new OrderfeeScriptContext
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If set to true the query will be cached for 60 seconds. If not set the query
     * will be executed again every time a script is executed.
     *
     * @var bool
     */
    public $cacheable;

    /**
     * The name of the variable that will be added to the script environment.
     *
     * @var string
     */
    public $key;

    /**
     * The query that will be executed on the public data model. The result will be
     * available in the script environment.
     *
     * @var string
     */
    public $query;

    /**
     * Unpack OrderfeeScriptContext from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderfeeScriptContext
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderfeeScriptContext(array(
            "cacheable" => isset($obj->cacheable) ? $obj->cacheable : null,
            "key" => isset($obj->key) ? $obj->key : null,
            "query" => isset($obj->query) ? $obj->query : null,
        ));
    }

    /**
     * Serialize OrderfeeScriptContext to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->cacheable)) {
            $result["cacheable"] = (bool)$this->cacheable;
        }
        if (!is_null($this->key)) {
            $result["key"] = strval($this->key);
        }
        if (!is_null($this->query)) {
            $result["query"] = strval($this->query);
        }

        return $result;
    }
}
