<?php
namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\Order;

class Orders
{

    /**
     * Add tickets to order
     *
     * @param int $id
     *
     * @param Ticket[]|array $data
     *
     * @throws ClientException
     *
     * @return Order
     */
    public static function addtickets(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new Ticket[]($data);
        }

    }

}
