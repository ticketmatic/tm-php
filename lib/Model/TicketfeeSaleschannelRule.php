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
 * This is a rule for a specific saleschannel that indicates the fee based on a
 * fixed amount or a percentage.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/TicketfeeSaleschannelRule).
 */
class TicketfeeSaleschannelRule implements \jsonSerializable
{
    /**
     * Create a new TicketfeeSaleschannelRule
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The saleschannel for which this rule is active.
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * The status sets the type of rule. Possible values:
     *
     * * `fixedfee`: A fixed ticket fee.
     *
     * * `percentagefee`: A fee thats a percentage of the ticket.
     *
     * @var string
     */
    public $status;

    /**
     * The value of this ticket fee. Can be an absolute amount (fixedfee) or a
     * percentage (percentagefee). In both cases only provide a decimal.
     *
     * @var float
     */
    public $value;

    /**
     * Unpack TicketfeeSaleschannelRule from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\TicketfeeSaleschannelRule
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new TicketfeeSaleschannelRule(array(
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "value" => isset($obj->value) ? $obj->value : null,
        ));
    }

    /**
     * Serialize TicketfeeSaleschannelRule to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->status)) {
            $result["status"] = strval($this->status);
        }
        if (!is_null($this->value)) {
            $result["value"] = floatval($this->value);
        }

        return $result;
    }
}
