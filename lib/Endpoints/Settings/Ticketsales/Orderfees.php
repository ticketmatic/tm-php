<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreateOrderFee;
use Ticketmatic\Model\OrderFee;
use Ticketmatic\Model\OrderFeeParameters;
use Ticketmatic\Model\UpdateOrderFee;

class Orderfees
{

    /**
     * Get a list of order fees
     *
     * @param OrderFeeParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListOrderFee[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new OrderFeeParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/orderfees");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListOrderFee", $result);
    }

    /**
     * Get a single order fee
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return OrderFee
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/orderfees/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderFee::fromJson($result);
    }

    /**
     * Create a new order fee
     *
     * @param CreateOrderFee|array $data
     *
     * @throws ClientException
     *
     * @return OrderFee
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateOrderFee($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/orderfees");
        $req->setBody($data);

        $result = $req->run();
        return OrderFee::fromJson($result);
    }

    /**
     * Modify an existing order fee
     *
     * @param int $id
     *
     * @param UpdateOrderFee|array $data
     *
     * @throws ClientException
     *
     * @return OrderFee
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateOrderFee($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/orderfees/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return OrderFee::fromJson($result);
    }

    /**
     * Remove an order fee
     *
     * Order fees are archivable: this call won't actually delete the object from the database.
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/orderfees/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify order fees
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/orderfees");

        $req->run();
    }
}
