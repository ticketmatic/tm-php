<?php
namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreateWebSalesSkin;
use Ticketmatic\Model\UpdateWebSalesSkin;
use Ticketmatic\Model\WebSalesSkin;
use Ticketmatic\Model\WebSalesSkinParameters;

class Webskins
{

    /**
     * Get a list of web sales skins
     *
     * @param WebSalesSkinParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListWebSalesSkin[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new WebSalesSkinParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/webskins");

        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListWebSalesSkin", $result);
    }

    /**
     * Get a single web sales skin
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return WebSalesSkin
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Create a new web sales skin
     *
     * @param CreateWebSalesSkin|array $data
     *
     * @throws ClientException
     *
     * @return WebSalesSkin
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateWebSalesSkin($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/webskins");
        $req->setBody($data);

        $result = $req->run();
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Modify an existing web sales skin
     *
     * @param int $id
     *
     * @param UpdateWebSalesSkin|array $data
     *
     * @throws ClientException
     *
     * @return WebSalesSkin
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateWebSalesSkin($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Remove a web sales skin
     *
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify web sales skins
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/webskins");

        $req->run();
    }
}
