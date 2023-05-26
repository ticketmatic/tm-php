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
 * A DeliveryscenarioAvailability defines when a delivery scenario
 * (api/types/DeliveryScenario) is available.
 *
 * This can be done in two ways:
 *
 * * By specifying a set of sales channels (required)
 *
 * * By writing a script (optional)
 *
 * In its simplest form, a `DeliveryscenarioAvailability` looks like this:
 *
 * ```js
 * {
 *     "saleschannels": [1, 2]
 * }
 * ```
 *
 * This defines that the delivery scenario is available when used in the context of
 * saleschannel `1` or `2`.
 *
 * More complex logic can be specified by writing a small piece of JavaScript
 * (http://en.wikipedia.org/wiki/JavaScript). To do so, you need to add a
 * `usescript` and `script` field to the availability:
 *
 * ```js
 * {
 *     "saleschannels": [1, 2],
 *     "usescript": true,
 *     "script": "// script here"
 * }
 * ```
 *
 * Note that the list of sales channel IDs is still required: the script can only
 * restrict this set further.
 *
 * A simple example of a delivery scenario script:
 *
 * ```js
 * return order.tickets.length < 3 && saleschannel.typeid == 3002;
 * ```
 *
 * This script states that the current delivery scenario is only available if the
 * amount of tickets in the order is less than 3 and the current sales channel is a
 * web sales channel.
 *
 * With this script the `DeliveryscenarioAvailability` would look like this:
 *
 * ```js
 * {
 *     "saleschannels": [1, 2],
 *     "usescript": true,
 *     "script": "return order.tickets.length < 3 && saleschannel.typeid == 3002;"
 * }
 * ```
 *
 * The following variables are available in the script:
 *
 * * `order`
 *
 * * `saleschannel`
 *
 * You can use any valid JavaScript syntax (including conditionals and loops).
 * Note that each script has a strict time limit.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/DeliveryscenarioAvailability).
 */
class DeliveryscenarioAvailability implements \jsonSerializable
{
    /**
     * Create a new DeliveryscenarioAvailability
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * An array of sales channel IDs for which this delivery scenario can be used
     *
     * @var int[]
     */
    public $saleschannels;

    /**
     * Script used to determine availability of the delivery scenario
     *
     * @var string
     */
    public $script;

    /**
     * Use a script to refine the set of sales channels?
     *
     * @var bool
     */
    public $usescript;

    /**
     * Unpack DeliveryscenarioAvailability from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\DeliveryscenarioAvailability
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new DeliveryscenarioAvailability(array(
            "saleschannels" => isset($obj->saleschannels) ? $obj->saleschannels : null,
            "script" => isset($obj->script) ? $obj->script : null,
            "usescript" => isset($obj->usescript) ? $obj->usescript : null,
        ));
    }

    /**
     * Serialize DeliveryscenarioAvailability to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }
        if (!is_null($this->script)) {
            $result["script"] = strval($this->script);
        }
        if (!is_null($this->usescript)) {
            $result["usescript"] = (bool)$this->usescript;
        }

        return $result;
    }
}
