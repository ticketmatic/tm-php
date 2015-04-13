<?php
namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
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
        if ($data == null || is_array($data)) {
            $data = new Ticket[]($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Order::fromJson($result);
    }
}
