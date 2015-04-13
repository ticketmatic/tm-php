<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateSalesChannel;
use Ticketmatic\Model\SalesChannel;
use Ticketmatic\Model\SalesChannelParameters;
use Ticketmatic\Model\UpdateSalesChannel;

/**
 * In Ticketmatic, each order is created in the context of a sales channel.
 *
 * ## Types
 *
 * There are 3 types of sales channels:
 *
 * * Desk (3001): for all orders in the Orders application
 *
 * * Web (3002): for orders from websites
 *
 * * External (3003): for orders sold by partners
 *
 * There is always exactly one sales channel of type Desk. Additionally you can define multiple
 * sales channels of types Web and External.
 *
 * ## Order mails
 *
 * Each sales channel can be configured with an order mail template. This template is used to send
 * order confirmations to customers. When (and if) this mail is sent is defined by the payment
 * method, but can be overridden per saleschannel.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_saleschannels).
 */
class Saleschannels
{

    /**
     * Get a list of sales channels
     *
     * @param SalesChannelParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListSalesChannel[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new SalesChannelParameters($params);
        }

    }

    /**
     * Get a single sales channel
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return SalesChannel
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new sales channel
     *
     * @param CreateSalesChannel|array $data
     *
     * @throws ClientException
     *
     * @return SalesChannel
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateSalesChannel($data);
        }

    }

    /**
     * Modify an existing sales channel
     *
     * @param int $id
     *
     * @param UpdateSalesChannel|array $data
     *
     * @throws ClientException
     *
     * @return SalesChannel
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateSalesChannel($data);
        }

    }

    /**
     * Remove a sales channel
     *
     * Sales channels are archivable: this call won't actually delete the object from the database.
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
     * Batch modify sales channels
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
