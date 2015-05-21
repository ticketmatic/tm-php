<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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

namespace Ticketmatic\Endpoints;

use Ticketmatic\Json;

/**
 * List results
 */
class OrdersList
{
    /**
     * Create a new OrdersList
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Result data
     *
     * @var \Ticketmatic\Model\Order[] $data
     */
    public $data;

    //region Lookup data

    /**
     * Contact details
     *
     * @var \Ticketmatic\Model\Contact[] $contacts
     */
    public $contacts;

    /**
     * Delivery scenarios
     *
     * @var \Ticketmatic\Model\DeliveryScenario[] $deliveryscenarios
     */
    public $deliveryscenarios;

    /**
     * events
     *
     * @var \Ticketmatic\Model\Event[] $events
     */
    public $events;

    /**
     * Payment methods
     *
     * @var \Ticketmatic\Model\PaymentMethod[] $paymentmethods
     */
    public $paymentmethods;

    /**
     * Payment scenarios
     *
     * @var \Ticketmatic\Model\PaymentScenario[] $paymentscenarios
     */
    public $paymentscenarios;

    /**
     * Price types
     *
     * @var \Ticketmatic\Model\PriceType[] $pricetypes
     */
    public $pricetypes;

    /**
     * Sales channels
     *
     * @var \Ticketmatic\Model\SalesChannel[] $saleschannels
     */
    public $saleschannels;

    /**
     * Service charges
     *
     * @var object[] $servicecharges
     */
    public $servicecharges;

    /**
     * Ticket types
     *
     * @var object[] $tickettypes
     */
    public $tickettypes;

    //endregion

    /**
     * Unpack OrdersList from JSON.
     *
     * @param object $obj
     *
     * @return OrdersList
     */
    public static function fromJson($obj) {
        return new OrdersList(array(
            "data" => Json::unpackArray("Order", $obj->data),
            "contacts" => Json::unpackArray("Contact", $obj->lookup->contacts),
            "deliveryscenarios" => Json::unpackArray("DeliveryScenario", $obj->lookup->deliveryscenarios),
            "events" => Json::unpackArray("Event", $obj->lookup->events),
            "paymentmethods" => Json::unpackArray("PaymentMethod", $obj->lookup->paymentmethods),
            "paymentscenarios" => Json::unpackArray("PaymentScenario", $obj->lookup->paymentscenarios),
            "pricetypes" => Json::unpackArray("PriceType", $obj->lookup->pricetypes),
            "saleschannels" => Json::unpackArray("SalesChannel", $obj->lookup->saleschannels),
            "servicecharges" => Json::unpackArray("object", $obj->lookup->servicecharges),
            "tickettypes" => Json::unpackArray("object", $obj->lookup->tickettypes),
        ));
    }
}
