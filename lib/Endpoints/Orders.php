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

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\AddItemsResult;
use Ticketmatic\Model\AddPayments;
use Ticketmatic\Model\AddProducts;
use Ticketmatic\Model\AddRefunds;
use Ticketmatic\Model\AddTickets;
use Ticketmatic\Model\BatchOrderOperation;
use Ticketmatic\Model\BatchResult;
use Ticketmatic\Model\CreateOrder;
use Ticketmatic\Model\DeleteProducts;
use Ticketmatic\Model\DeleteTickets;
use Ticketmatic\Model\ImportOrder;
use Ticketmatic\Model\LogItem;
use Ticketmatic\Model\Order;
use Ticketmatic\Model\OrderIdReservation;
use Ticketmatic\Model\OrderImportStatus;
use Ticketmatic\Model\OrderQuery;
use Ticketmatic\Model\PaymentRequest;
use Ticketmatic\Model\PurgeOrdersRequest;
use Ticketmatic\Model\SplitOrder;
use Ticketmatic\Model\TicketsEmaildeliveryRequest;
use Ticketmatic\Model\TicketsPdfRequest;
use Ticketmatic\Model\UpdateOrder;
use Ticketmatic\Model\UpdateProducts;
use Ticketmatic\Model\UpdateTickets;
use Ticketmatic\Model\Url;

/**
 * Orders are one of the main concepts in Ticketmatic. These operations allow you
 * to create, update and read orders. You can add and remove tickets to orders and
 * add payments.
 *
 * A users currently active basket (or cart) is also handled using an (unconfirmed)
 * order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/orders).
 */
class Orders
{

    /**
     * Get a list of orders
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderQuery|array $params
     *
     * @throws ClientException
     *
     * @return OrdersList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new OrderQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/orders");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("limit", $params->limit);
        $req->addQuery("offset", $params->offset);
        $req->addQuery("orderby", $params->orderby);
        $req->addQuery("orderby_asc", $params->orderby_asc);
        $req->addQuery("output", $params->output);
        $req->addQuery("searchterm", $params->searchterm);
        $req->addQuery("simplefilter", $params->simplefilter);

        $result = $req->run("json");
        return OrdersList::fromJson($result);
    }

    /**
     * Get a single order
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/orders/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Create a new order
     *
     * Creates a new empty order.
     *
     * Each order is linked to a sales channel (api/types/SalesChannel), which needs to
     * be supplied when creating.
     *
     * **Note:** This method may return a `429 Rate Limit Exceeded` status when there
     * is too much demand.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreateOrder|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new CreateOrder($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Update an order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdateOrder|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new UpdateOrder($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/orders/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Delete an order
     *
     * Delete an order.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/orders/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Batch operations
     *
     * Apply batch operations to a set of orders.
     *
     * The parameters required are specific to the type of operation.
     *
     * ## What will be affected?
     *
     * The operation will be applied to the orders with given IDs. The amount of IDs is
     * limited to 1000 per call.
     *
     * ```
     * ids: [1, 2, 3]
     * ```
     *
     * This will apply the operation to orders with ID `1`, `2` and `3`.
     *
     * ## Batch operations
     *
     * The following operations are supported:
     *
     * * `emaildelivery`: Send the delivery email to a selection of orders.
     *
     * * `pdf`: Print a selection of orders.
     *
     * * `update`: Update a specific field for the selection of orders. See
     * BatchOrderParameters (api/types/BatchOrderParameters) for more info.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\BatchOrderOperation|array $data
     *
     * @throws ClientException
     */
    public static function batch(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new BatchOrderOperation($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/batch");
        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Delete orders
     *
     * Delete multiple orders.
     *
     * @param Client $client
     * @param int[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\BatchResult
     */
    public static function deletebatch(Client $client, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new int($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("DELETE", "/{accountname}/orders");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return BatchResult::fromJson($result);
    }

    /**
     * Confirm an order
     *
     * Marks the order as confirmed.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function confirm(Client $client, $id) {
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Split tickets and/or products from an order into a new one.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\SplitOrder|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function split(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new SplitOrder($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/split");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Add tickets to order
     *
     * When adding tickets, this is limited to 50 tickets per call. **Note:** This
     * method may return a `429 Rate Limit Exceeded` status when there is too much
     * demand.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\AddTickets|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AddItemsResult
     */
    public static function addtickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new AddTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return AddItemsResult::fromJson($result);
    }

    /**
     * Modify tickets in order
     *
     * Individual tickets can be updated. Per call you can specify any number of ticket
     * IDs and one operation.
     *
     * Each operation accepts different parameters, dependent on the operation type:
     *
     * * **Set ticket holders**: an array of ticket holder IDs (see Contact
     * (api/types/Contact)), one for each ticket (`ticketholderids`).
     *
     * * **Update price type**: an array of ticket price type IDs (as can be found in
     * the Event pricing (api/types/Event)), one for each ticket (`tickettypepriceids`)
     *
     * * **Add to bundles**: an array of bundle IDs, one for each ticket
     *
     * * **Remove from bundles**: none.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdateTickets|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function updatetickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new UpdateTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/orders/{id}/tickets");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Remove tickets from order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\DeleteTickets|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function deletetickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new DeleteTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("DELETE", "/{accountname}/orders/{id}/tickets");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Add products to order
     *
     * Add products to order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\AddProducts|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AddItemsResult
     */
    public static function addproducts(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new AddProducts($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/products");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return AddItemsResult::fromJson($result);
    }

    /**
     * Modify products in order
     *
     * Individual products can be updated. Per call you can specify any number of
     * product IDs and one operation.
     *
     * Each operation accepts different parameters, dependent on the operation type:
     *
     * * **Set product holders**: an array of ticket holder IDs (see Contact
     * (api/types/Contact)), one for each product (`productholderids`). *
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdateProducts|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function updateproducts(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new UpdateProducts($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/orders/{id}/products");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Remove products from order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\DeleteProducts|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function deleteproducts(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new DeleteProducts($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("DELETE", "/{accountname}/orders/{id}/products");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Add payments to order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\AddPayments|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function addpayments(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new AddPayments($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/payments");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Add refund for payment for order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\AddRefunds|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function addrefunds(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new AddRefunds($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/refunds");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Get the log history for an order
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LogItem[]
     */
    public static function getlogs(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/orders/{id}/logs");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Json::unpackArray("LogItem", $result);
    }

    /**
     * [DEPRECATED] Export tickets to PDF
     *
     * DEPRECATED: Use /{id}/pdf instead.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketsPdfRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Url
     */
    public static function postticketspdf(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new TicketsPdfRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets/pdf");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Url::fromJson($result);
    }

    /**
     * Export tickets and/or vouchercodes to PDF
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketsPdfRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Url
     */
    public static function postpdf(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new TicketsPdfRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/pdf");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Url::fromJson($result);
    }

    /**
     * Send the delivery e-mail for the order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketsEmaildeliveryRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function postticketsemaildelivery(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new TicketsEmaildeliveryRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets/emaildelivery");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Send the payment instruction e-mail
     *
     * Send the payment instruction e-mail for the order that is linked to the payment
     * scenario. Will only be sent if saldo <> 0 and paymentinstruction contains a
     * valid payment instruction template.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function postticketsemailpaymentinstruction(Client $client, $id) {
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets/emailpaymentinstruction");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Order::fromJson($result);
    }

    /**
     * Create a payment request for an online payment for the order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\PaymentRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Url
     */
    public static function postpaymentrequest(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new PaymentRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/paymentrequest");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Url::fromJson($result);
    }

    /**
     * Cancel the outstanding payment request for the order
     *
     * A payment request can only be cancelled when its status is open.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function cancelpaymentrequest(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/orders/{id}/paymentrequest");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Get the PDF for a document for the order
     *
     * @param Client $client
     * @param int $id
     * @param string $documentid
     * @param string $language
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Url
     */
    public static function getdocument(Client $client, $id, $documentid, $language) {
        $req = $client->newRequest("GET", "/{accountname}/orders/{id}/documents/{documentid}/{language}");
        $req->addParameter("id", $id);

        $req->addParameter("documentid", $documentid);

        $req->addParameter("language", $language);


        $result = $req->run("json");
        return Url::fromJson($result);
    }

    /**
     * Import historic orders
     *
     * Up to 100 orders can be sent per call.
     *
     * Many of the usual consistency checks are relaxed while importing orders.
     * It is recommended that you only import orders that will not be changed anymore
     * in the future.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ImportOrder[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderImportStatus[]
     */
    public static function import(Client $client, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new ImportOrder($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/import");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Json::unpackArray("OrderImportStatus", $result);
    }

    /**
     * Reserve order IDs
     *
     * Importing orders with specified IDs is only possible when those IDs fall in the
     * reserved ID range.
     *
     * Use this call to reserve a range of order IDs. Any unused ID lower than or equal
     * to the specified ID will be reserved. New orders will receive IDs higher than
     * the specified ID.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderIdReservation|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderIdReservation
     */
    public static function reserve(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new OrderIdReservation($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/import/reserve");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return OrderIdReservation::fromJson($result);
    }

    /**
     * Purge orders
     *
     * Purge all orders. This is only possible for test or staging accounts.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PurgeOrdersRequest|array $params
     *
     * @throws ClientException
     *
     * @return string
     */
    public static function purge(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new PurgeOrdersRequest($params == null ? array() : $params);
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/purge");

        $req->addQuery("contacts", $params->contacts);
        $req->addQuery("createdsince", $params->createdsince);
        $req->addQuery("events", $params->events);

        $result = $req->run("json");
        return $result;
    }
}
