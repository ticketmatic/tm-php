<?php
namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateRevenueSplit;
use Ticketmatic\Model\RevenueSplit;
use Ticketmatic\Model\RevenueSplitParameters;
use Ticketmatic\Model\UpdateRevenueSplit;

/**
 * Revenue splits are schemes that define how the ticket revenue will be split internally. In a
 * revenue split scheme a split for each revenue split category is defined. The split can either
 * be a fixed amount or a percentage amount on the ticket price.
 *
 * By linking a revenue split to an event, you define how the ticket revenue will be split for
 * that event. The same revenue split can be linked to multiple events.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_revenuesplits).
 */
class Revenuesplits
{

    /**
     * Get a list of revenue splits
     *
     * @param RevenueSplitParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListRevenueSplit[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new RevenueSplitParameters($params);
        }

    }

    /**
     * Get a single revenue split
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return RevenueSplit
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new revenue split
     *
     * @param CreateRevenueSplit|array $data
     *
     * @throws ClientException
     *
     * @return RevenueSplit
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateRevenueSplit($data);
        }

    }

    /**
     * Modify an existing revenue split
     *
     * @param int $id
     *
     * @param UpdateRevenueSplit|array $data
     *
     * @throws ClientException
     *
     * @return RevenueSplit
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateRevenueSplit($data);
        }

    }

    /**
     * Remove a revenue split
     *
     * Revenue splits are archivable: this call won't actually delete the object from the database.
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
     * Batch modify revenue splits
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
