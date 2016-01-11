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
 * Defines which fees are active for specific price types and sales channels. It's
 * possible to define a fixed fee and a percentage based fee. The default rule (if
 * none is specified for a specific sales channel) is always a fixed fee of 0.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/TicketfeeRules).
 */
class TicketfeeRules implements \jsonSerializable
{
    /**
     * Create a new TicketfeeRules
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The default ticket fee rule, one rule for each saleschannel.
     *
     * @var \Ticketmatic\Model\TicketfeeSaleschannelRule[]
     */
    public $default;

    /**
     * An array of exception rules for specific pricetypes.
     *
     * @var \Ticketmatic\Model\TicketfeeException[]
     */
    public $exceptions;

    /**
     * Unpack TicketfeeRules from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\TicketfeeRules
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new TicketfeeRules(array(
            "default" => isset($obj->default) ? Json::unpackArray("TicketfeeSaleschannelRule", $obj->default) : null,
            "exceptions" => isset($obj->exceptions) ? Json::unpackArray("TicketfeeException", $obj->exceptions) : null,
        ));
    }

    /**
     * Serialize TicketfeeRules to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->default)) {
            $result["default"] = $this->default;
        }
        if (!is_null($this->exceptions)) {
            $result["exceptions"] = $this->exceptions;
        }

        return $result;
    }
}
