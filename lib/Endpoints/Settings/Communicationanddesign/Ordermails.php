<?php
namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreateOrderMailTemplate;
use Ticketmatic\Model\OrderMailTemplate;
use Ticketmatic\Model\OrderMailTemplateParameters;
use Ticketmatic\Model\UpdateOrderMailTemplate;

class Ordermails
{

    /**
     * Get a list of order mail templates
     *
     * @param OrderMailTemplateParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListOrderMailTemplate[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new OrderMailTemplateParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListOrderMailTemplate", $result);
    }

    /**
     * Get a single order mail template
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return OrderMailTemplate
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Create a new order mail template
     *
     * @param CreateOrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return OrderMailTemplate
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateOrderMailTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/ordermails");
        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Modify an existing order mail template
     *
     * @param int $id
     *
     * @param UpdateOrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return OrderMailTemplate
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateOrderMailTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Remove an order mail template
     *
     * Order mail templates are archivable: this call won't actually delete the object from the
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify order mail templates
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ordermails");

        $req->run();
    }
}
