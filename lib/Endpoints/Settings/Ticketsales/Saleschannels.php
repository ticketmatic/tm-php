<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
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
        if ($params == null || is_array($params)) {
            $params = new SalesChannelParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/saleschannels");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListSalesChannel", $result);
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
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/saleschannels/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return SalesChannel::fromJson($result);
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
        if ($data == null || is_array($data)) {
            $data = new CreateSalesChannel($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/saleschannels");
        $req->setBody($data);

        $result = $req->run();
        return SalesChannel::fromJson($result);
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
        if ($data == null || is_array($data)) {
            $data = new UpdateSalesChannel($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/saleschannels/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return SalesChannel::fromJson($result);
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/saleschannels/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify sales channels
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/saleschannels");

        $req->run();
    }
}
