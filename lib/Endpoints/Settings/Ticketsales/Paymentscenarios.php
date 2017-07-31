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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\PaymentScenario;
use Ticketmatic\Model\PaymentScenarioQuery;

/**
 * A payment scenario defines how a customer will pay for an order. This is not
 * necessarily linked to a specific payment. When a customer selects a payment
 * scenario for an order, a process is started. The actual process depends on the
 * type of payment scenario:
 *
 * * **Immediate payment**: in this case, the payment must be executed immediately
 * by using one of the payment methods that is linked to the payment scenario.
 *
 * * **Deferred payment**: in this case, the payment can be executed later and the
 * order can be confirmed without payment. You can configure overdue and expiry
 * parameters to define how long the order can stay unpaid before considering the
 * order as overdue or expired and sending out reminder mails or even cancelling
 * the order automatically
 *
 * An order fee can defined for a payment scenario: this fee will automatically be
 * added to the order when the payment scenario is selected.false
 *
 * A payment scenario is available for one or more sales channels. A custom script
 * can further refine when the payment scenario is available.
 *
 * Examples include: Credit card, Bank transfer, Cash
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentscenarios).
 */
class Paymentscenarios
{

    /**
     * Get a list of payment scenarios
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PaymentScenarioQuery|array $params
     *
     * @throws ClientException
     *
     * @return PaymentscenariosList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new PaymentScenarioQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentscenarios");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return PaymentscenariosList::fromJson($result);
    }

    /**
     * Get a single payment scenario
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentScenario
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return PaymentScenario::fromJson($result);
    }

    /**
     * Create a new payment scenario
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PaymentScenario|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentScenario
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new PaymentScenario($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/paymentscenarios");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return PaymentScenario::fromJson($result);
    }

    /**
     * Modify an existing payment scenario
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\PaymentScenario|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PaymentScenario
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new PaymentScenario($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return PaymentScenario::fromJson($result);
    }

    /**
     * Remove a payment scenario
     *
     * Payment scenarios are archivable: this call won't actually delete the object
     * from the database. Instead, it will mark the object as archived, which means it
     * won't show up anymore in most places.
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * See translations (api/coreconcepts/translations) for more information.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentscenarios/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return $result;
    }

    /**
     * Update translations
     *
     * Sets updated translation strings.
     *
     * See translations (api/coreconcepts/translations) for more information.
     *
     * @param Client $client
     * @param int $id
     * @param string[]|array $data
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translate(Client $client, $id, $data) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentscenarios/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return $result;
    }
}
