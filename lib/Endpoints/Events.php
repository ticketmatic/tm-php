<?php
namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\Event;
use Ticketmatic\Model\EventParameters;

class Events
{

    /**
     * Get a list of events
     *
     * @param EventParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListEvent[]
     */
    public static function list(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new EventParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/events");

        $req->addQuery("includearchived", $params->includearchived);

        $result = $req->run();
        return Json::unpackArray("ListEvent", $result);
    }

    /**
     * Get an event
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return Event
     */
    public static function single(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/events/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return Event::fromJson($result);
    }
}
