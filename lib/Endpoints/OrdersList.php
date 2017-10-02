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

    /**
     * The total number of results that are available without considering limit and offset, useful for paging.
     *
     * @var int $nbrofresults
     */
    public $nbrofresults;

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
     * Events
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
     * Product categories
     *
     * @var \Ticketmatic\Model\ProductCategory[] $productcategories
     */
    public $productcategories;

    /**
     * Products
     *
     * @var \Ticketmatic\Model\Product[] $products
     */
    public $products;

    /**
     * Sales channels
     *
     * @var \Ticketmatic\Model\SalesChannel[] $saleschannels
     */
    public $saleschannels;

    /**
     * Service charges
     *
     * @var \Ticketmatic\Model\OrderFeeDefinition[] $servicecharges
     */
    public $servicecharges;

    /**
     * Ticket types
     *
     * @var \Ticketmatic\Model\OrderTickettype[] $tickettypes
     */
    public $tickettypes;

    /**
     * Voucher codes
     *
     * @var string[] $vouchercodes
     */
    public $vouchercodes;

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
            "nbrofresults" => isset($obj->nbrofresults) ? intval($obj->nbrofresults) : 0,
            "contacts" => isset($obj->lookup->contacts) ? Json::unpackArray("Contact", $obj->lookup->contacts) : null,
            "deliveryscenarios" => isset($obj->lookup->deliveryscenarios) ? Json::unpackArray("DeliveryScenario", $obj->lookup->deliveryscenarios) : null,
            "events" => isset($obj->lookup->events) ? Json::unpackArray("Event", $obj->lookup->events) : null,
            "paymentmethods" => isset($obj->lookup->paymentmethods) ? Json::unpackArray("PaymentMethod", $obj->lookup->paymentmethods) : null,
            "paymentscenarios" => isset($obj->lookup->paymentscenarios) ? Json::unpackArray("PaymentScenario", $obj->lookup->paymentscenarios) : null,
            "pricetypes" => isset($obj->lookup->pricetypes) ? Json::unpackArray("PriceType", $obj->lookup->pricetypes) : null,
            "productcategories" => isset($obj->lookup->productcategories) ? Json::unpackArray("ProductCategory", $obj->lookup->productcategories) : null,
            "products" => isset($obj->lookup->products) ? Json::unpackArray("Product", $obj->lookup->products) : null,
            "saleschannels" => isset($obj->lookup->saleschannels) ? Json::unpackArray("SalesChannel", $obj->lookup->saleschannels) : null,
            "servicecharges" => isset($obj->lookup->servicecharges) ? Json::unpackArray("OrderFeeDefinition", $obj->lookup->servicecharges) : null,
            "tickettypes" => isset($obj->lookup->tickettypes) ? Json::unpackArray("OrderTickettype", $obj->lookup->tickettypes) : null,
            "vouchercodes" => isset($obj->lookup->vouchercodes) ? $obj->lookup->vouchercodes : null,
        ));
    }
}
