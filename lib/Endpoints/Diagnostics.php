<?php
namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\Timestamp;

class Diagnostics
{

    /**
     * Get the backend time
     *
     * Returns the current system time, in UTC.
     *
     * The returned timestamp uses the ISO-8601 format.
     *
     * @throws ClientException
     *
     * @return Timestamp
     */
    public static function time(Client $client) {


    }

}
