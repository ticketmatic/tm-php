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
 * A CustomfieldAvailability configures in what saleschannels a custom field is
 * available (during the checkout).
 *
 * It can also further refine the availability based on a script written in
 * JavaScript.
 *
 * More information about writing order scripts can be found here
 * (tickets/configure_ticket_sales/orderfees).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CustomfieldAvailability).
 */
class CustomfieldAvailability implements \jsonSerializable
{
    /**
     * Create a new CustomfieldAvailability
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The custom field will be available for these saleschannels. It this is empty the
     * custom field will not be available.
     *
     * @var int[]
     */
    public $saleschannels;

    /**
     * A Javascript that needs to return a boolean. It has the current order available.
     *
     * @var string
     */
    public $script;

    /**
     * Indicates if the script will be used.
     *
     * @var bool
     */
    public $usescript;

    /**
     * Unpack CustomfieldAvailability from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CustomfieldAvailability
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new CustomfieldAvailability(array(
            "saleschannels" => isset($obj->saleschannels) ? $obj->saleschannels : null,
            "script" => isset($obj->script) ? $obj->script : null,
            "usescript" => isset($obj->usescript) ? $obj->usescript : null,
        ));
    }

    /**
     * Serialize CustomfieldAvailability to JSON.
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
