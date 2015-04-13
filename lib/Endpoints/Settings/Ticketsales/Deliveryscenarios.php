<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
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
        if (is_array($params)) {
            $params = new DeliveryScenarioParameters($params);
        }

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
        if (is_array($data)) {
            $data = new CreateDeliveryScenario($data);
        }

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
        if (is_array($data)) {
            $data = new UpdateDeliveryScenario($data);
        }

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


    }

    /**
     * Batch modify delivery scenarios
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
