<?php
namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreatePriceAvailability;
use Ticketmatic\Model\PriceAvailability;
use Ticketmatic\Model\PriceAvailabilityParameters;
use Ticketmatic\Model\UpdatePriceAvailability;

/**
 * A price availability is a scheme that indicates which price types are available for which
 * saleschannel. A typical price availability might for example state that price type "Standard"
 * is available on all saleschanels, while price type "Guest" is only available on the "Boxoffice"
 * saleschannel.
 *
 * A price availability is selected for each event.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_priceavailabilities).
 */
class Priceavailabilities
{

    /**
     * Get a list of price availabilities
     *
     * @param PriceAvailabilityParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListPriceAvailability[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new PriceAvailabilityParameters($params);
        }

    }

    /**
     * Get a single price availability
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return PriceAvailability
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new price availability
     *
     * @param CreatePriceAvailability|array $data
     *
     * @throws ClientException
     *
     * @return PriceAvailability
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreatePriceAvailability($data);
        }

    }

    /**
     * Modify an existing price availability
     *
     * @param int $id
     *
     * @param UpdatePriceAvailability|array $data
     *
     * @throws ClientException
     *
     * @return PriceAvailability
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdatePriceAvailability($data);
        }

    }

    /**
     * Remove a price availability
     *
     * Price availabilities are archivable: this call won't actually delete the object from the
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
     * Batch modify price availabilities
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
