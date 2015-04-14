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

namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreatePaymentMethod;
use Ticketmatic\Model\PaymentMethod;
use Ticketmatic\Model\PaymentMethodParameters;
use Ticketmatic\Model\UpdatePaymentMethod;

/**
 * A payment method defines the method of an actual payment. Each payment is done
 * by a specific payment method.
 *
 * In the payment method, the type and if appropriate the technical parameters for
 * performing the payment are defined. These parameters depend on the payment
 * gateway used.
 *
 * Not all payment methods can be used in all contexts.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentmethods).
 */
class Paymentmethods
{

    /**
     * Get a list of payment methods
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PaymentMethodParameters|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ListPaymentMethod[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new PaymentMethodParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentmethods");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListPaymentMethod", $result);
    }

    /**
     * Get a single payment method
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentMethod
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentmethods/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return PaymentMethod::fromJson($result);
    }

    /**
     * Create a new payment method
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreatePaymentMethod|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentMethod
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreatePaymentMethod($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/paymentmethods");
        $req->setBody($data);

        $result = $req->run();
        return PaymentMethod::fromJson($result);
    }

    /**
     * Modify an existing payment method
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdatePaymentMethod|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentMethod
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdatePaymentMethod($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentmethods/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return PaymentMethod::fromJson($result);
    }

    /**
     * Remove a payment method
     *
     * Payment methods are archivable: this call won't actually delete the object from
     * the database. Instead, it will mark the object as archived, which means it won't
     * show up anymore in most places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure
     * consistency of historical data.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/paymentmethods/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify payment methods
     *
     * @param Client $client
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentmethods");

        $req->run();
    }
}
