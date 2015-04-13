<?php
namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
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
        if (is_array($params)) {
            $params = new WebSalesSkinParameters($params);
        }

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
        if (is_array($data)) {
            $data = new CreateWebSalesSkin($data);
        }

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
        if (is_array($data)) {
            $data = new UpdateWebSalesSkin($data);
        }

    }

    /**
     * Remove a web sales skin
     *
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {


    }

    /**
     * Batch modify web sales skins
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
