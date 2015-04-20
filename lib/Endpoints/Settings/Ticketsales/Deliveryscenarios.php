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
use Ticketmatic\Model\DeliveryScenario;
use Ticketmatic\Model\DeliveryScenarioQuery;

/**
 * A delivery scenario defines how an order will be delivered.
 *
 * You can define an order fee for a delivery scenario and you can define in which
 * conditions a delivery scenario is available. Typically, the customer will select
 * the delivery scenario most appropriate for him.
 *
 * Examples include: Print at home, Mobile, Send by mail, Retrieve at desk
 *
 * ## Types
 *
 * There are 3 types of delivery scenarios:
 *
 * * **Manual (`2501`)**: delivery of the tickets will happen manually by the
 * seller. This could be via a daily or weekly print.
 *
 * * **Automatic after full payment (`2502`)**: Ticketmatic will deliver the
 * tickets automatically once the outstanding balance for the order reaches 0 (full
 * payment).
 *
 * * **Automatic after confirmation (`2503`)**: Ticketmatic will deliver the
 * tickets automatically as soon as the order is confirmed.
 *
 * ## Availability
 *
 * The full rules for defining when a delivery scenario can be used are defined in
 * DeliveryscenarioAvailability
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/DeliveryscenarioAvailability).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios).
 */
class Deliveryscenarios
{

    /**
     * Get a list of delivery scenarios
     *
     * @param Client $client
     * @param \Ticketmatic\Model\DeliveryScenarioQuery|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\DeliveryScenario[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new DeliveryScenarioQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/deliveryscenarios");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("DeliveryScenario", $result);
    }

    /**
     * Get a single delivery scenario
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\DeliveryScenario
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/deliveryscenarios/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return DeliveryScenario::fromJson($result);
    }

    /**
     * Create a new delivery scenario
     *
     * @param Client $client
     * @param \Ticketmatic\Model\DeliveryScenario|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\DeliveryScenario
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new DeliveryScenario($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/deliveryscenarios");
        $req->setBody($data);

        $result = $req->run();
        return DeliveryScenario::fromJson($result);
    }

    /**
     * Modify an existing delivery scenario
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\DeliveryScenario|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\DeliveryScenario
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new DeliveryScenario($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/deliveryscenarios/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return DeliveryScenario::fromJson($result);
    }

    /**
     * Remove a delivery scenario
     *
     * Delivery scenarios are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/deliveryscenarios/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
