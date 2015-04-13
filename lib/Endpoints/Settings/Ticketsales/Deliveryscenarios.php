<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreateDeliveryScenario;
use Ticketmatic\Model\DeliveryScenario;
use Ticketmatic\Model\DeliveryScenarioParameters;
use Ticketmatic\Model\UpdateDeliveryScenario;

/**
 * A delivery scenario defines how an order will be delivered.
 *
 * You can define an order fee for a delivery scenario and you can define in which conditions a
 * delivery scenario is available. Typically, the customer will select the delivery scenario most
 * appropriate for him.
 *
 * Examples include: Print at home, Mobile, Send by mail, Retrieve at desk
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
     * @param DeliveryScenarioParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListDeliveryScenario[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new DeliveryScenarioParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/deliveryscenarios");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListDeliveryScenario", $result);
    }

    /**
     * Get a single delivery scenario
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return DeliveryScenario
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
     * @param CreateDeliveryScenario|array $data
     *
     * @throws ClientException
     *
     * @return DeliveryScenario
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateDeliveryScenario($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/deliveryscenarios");
        $req->setBody($data);

        $result = $req->run();
        return DeliveryScenario::fromJson($result);
    }

    /**
     * Modify an existing delivery scenario
     *
     * @param int $id
     *
     * @param UpdateDeliveryScenario|array $data
     *
     * @throws ClientException
     *
     * @return DeliveryScenario
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateDeliveryScenario($data == null ? array() : $data);
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
     * Delivery scenarios are archivable: this call won't actually delete the object from the
     * database. Instead, it will mark the object as archived, which means it won't show up anymore in
     * most places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure consistency of
     * historical data.
     *
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/deliveryscenarios/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify delivery scenarios
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/deliveryscenarios");

        $req->run();
    }
}
