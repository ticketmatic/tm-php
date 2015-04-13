<?php
namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateTicketFee;
use Ticketmatic\Model\TicketFee;
use Ticketmatic\Model\TicketFeeParameters;
use Ticketmatic\Model\UpdateTicketFee;

/**
 * Ticket fees are schemes that define what fee will be added to the ticket price, depending on
 * the price type and the sales channel used when the ticket is sold. The fee can either be a
 * fixed cost or a percentage cost.
 *
 * By linking a ticketfee scheme to an event, the fees that will be applied to tickets for that
 * event are defined. The same ticket fee can be linked to multiple events. Changing a ticket fee
 * scheme will automatically update this for all linked events (the new fees will only be applied
 * for new orders, fees for tickets that are already sold will not change).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_ticketfees).
 */
class Ticketfees
{

    /**
     * Get a list of ticket fees
     *
     * @param TicketFeeParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListTicketFee[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new TicketFeeParameters($params);
        }

    }

    /**
     * Get a single ticket fee
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return TicketFee
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new ticket fee
     *
     * @param CreateTicketFee|array $data
     *
     * @throws ClientException
     *
     * @return TicketFee
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateTicketFee($data);
        }

    }

    /**
     * Modify an existing ticket fee
     *
     * @param int $id
     *
     * @param UpdateTicketFee|array $data
     *
     * @throws ClientException
     *
     * @return TicketFee
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateTicketFee($data);
        }

    }

    /**
     * Remove a ticket fee
     *
     * Ticket fees are archivable: this call won't actually delete the object from the database.
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
     * Batch modify ticket fees
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
