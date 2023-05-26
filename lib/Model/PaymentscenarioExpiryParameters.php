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
 * The PaymentscenarioExpiryParameters can only be set when the Paymentscenario is
 * of a type deferred payment.
 *
 * It determines the moment in time when an order expires. It's calculated as
 * `MIN(<order creation date> + daysafterordercreation, <date of first event in
 * order> - daysbeforeevent)`. If `deleteonexpiry` is set to true, the order will
 * be deleted.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PaymentscenarioExpiryParameters).
 */
class PaymentscenarioExpiryParameters implements \jsonSerializable
{
    /**
     * Create a new PaymentscenarioExpiryParameters
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The amount of days after the paymentscenario was set that the order becomes
     * overdue.
     *
     * @var int
     */
    public $daysaftercreation;

    /**
     * DEPRECATED, use daysaftercreation. The amount of days after an order has been
     * created that the order becomes overdue.
     *
     * @var int
     */
    public $daysafterordercreation;

    /**
     * DEPRECATED, use daysaftercreation. The number of days before an event that an
     * order becomes overdue.
     *
     * @var int
     */
    public $daysbeforeevent;

    /**
     * Indicates is the order will be deleted when it's expired.
     *
     * @var bool
     */
    public $deleteonexpiry;

    /**
     * Unpack PaymentscenarioExpiryParameters from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PaymentscenarioExpiryParameters
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PaymentscenarioExpiryParameters(array(
            "daysaftercreation" => isset($obj->daysaftercreation) ? $obj->daysaftercreation : null,
            "daysafterordercreation" => isset($obj->daysafterordercreation) ? $obj->daysafterordercreation : null,
            "daysbeforeevent" => isset($obj->daysbeforeevent) ? $obj->daysbeforeevent : null,
            "deleteonexpiry" => isset($obj->deleteonexpiry) ? $obj->deleteonexpiry : null,
        ));
    }

    /**
     * Serialize PaymentscenarioExpiryParameters to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->daysaftercreation)) {
            $result["daysaftercreation"] = intval($this->daysaftercreation);
        }
        if (!is_null($this->daysafterordercreation)) {
            $result["daysafterordercreation"] = intval($this->daysafterordercreation);
        }
        if (!is_null($this->daysbeforeevent)) {
            $result["daysbeforeevent"] = intval($this->daysbeforeevent);
        }
        if (!is_null($this->deleteonexpiry)) {
            $result["deleteonexpiry"] = (bool)$this->deleteonexpiry;
        }

        return $result;
    }
}
