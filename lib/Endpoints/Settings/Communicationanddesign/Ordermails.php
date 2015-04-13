<?php
namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
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
        if (is_array($params)) {
            $params = new OrderMailTemplateParameters($params);
        }

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
        if (is_array($data)) {
            $data = new CreateOrderMailTemplate($data);
        }

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
        if (is_array($data)) {
            $data = new UpdateOrderMailTemplate($data);
        }

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


    }

    /**
     * Batch modify order mail templates
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
