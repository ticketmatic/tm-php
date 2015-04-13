<?php
namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateRevenueSplitCategory;
use Ticketmatic\Model\RevenueSplitCategory;
use Ticketmatic\Model\RevenueSplitCategoryParameters;
use Ticketmatic\Model\UpdateRevenueSplitCategory;

/**
 * Revenue split categories are the categories used to split the ticket revenue internally.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_revenuesplitcategories).
 */
class Revenuesplitcategories
{

    /**
     * Get a list of revenue split categories
     *
     * @param RevenueSplitCategoryParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListRevenueSplitCategory[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new RevenueSplitCategoryParameters($params);
        }

    }

    /**
     * Get a single revenue split category
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return RevenueSplitCategory
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new revenue split category
     *
     * @param CreateRevenueSplitCategory|array $data
     *
     * @throws ClientException
     *
     * @return RevenueSplitCategory
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateRevenueSplitCategory($data);
        }

    }

    /**
     * Modify an existing revenue split category
     *
     * @param int $id
     *
     * @param UpdateRevenueSplitCategory|array $data
     *
     * @throws ClientException
     *
     * @return RevenueSplitCategory
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateRevenueSplitCategory($data);
        }

    }

    /**
     * Remove a revenue split category
     *
     * Revenue split categories are archivable: this call won't actually delete the object from the
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
     * Batch modify revenue split categories
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
