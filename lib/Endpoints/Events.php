<?php
namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
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
        if (is_array($params)) {
            $params = new EventParameters($params);
        }

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


    }

}
