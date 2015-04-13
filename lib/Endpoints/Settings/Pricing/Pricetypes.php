<?php
namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreatePriceType;
use Ticketmatic\Model\PriceType;
use Ticketmatic\Model\PriceTypeParameters;
use Ticketmatic\Model\UpdatePriceType;

/**
 * Pricetypes describe the different types of prices that exist for an event, for example
 * "Standard", "Reduction -26", "Guest" or "VIP". Pricetypes are used in pricelists to define
 * actual prices. Pricetypes are global for the account. Pricetypes are themselves categorized in:
 *
 * * Normal (id 2302)
 *
 * * Reduction (id 2302)
 *
 * * Special (id 2303)
 *
 * * Free (id 2304)
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricetypes).
 */
class Pricetypes
{

    /**
     * Get a list of price types
     *
     * @param PriceTypeParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListPriceType[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new PriceTypeParameters($params);
        }

    }

    /**
     * Get a single price type
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return PriceType
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new price type
     *
     * @param CreatePriceType|array $data
     *
     * @throws ClientException
     *
     * @return PriceType
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreatePriceType($data);
        }

    }

    /**
     * Modify an existing price type
     *
     * @param int $id
     *
     * @param UpdatePriceType|array $data
     *
     * @throws ClientException
     *
     * @return PriceType
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdatePriceType($data);
        }

    }

    /**
     * Remove a price type
     *
     * Price types are archivable: this call won't actually delete the object from the database.
     * Instead, it will mark the object as archived, which means it won't show up anymore in most
     * places.
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
     * Batch modify price types
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
