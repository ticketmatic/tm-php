<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\Event;
use Ticketmatic\Model\EventLockTickets;
use Ticketmatic\Model\EventQuery;
use Ticketmatic\Model\EventTicket;
use Ticketmatic\Model\EventTicketQuery;
use Ticketmatic\Model\EventUnlockTickets;
use Ticketmatic\Model\EventUpdateSeatRankForTickets;

/**
 * Before using events through the API, be sure to read the event setup guide
 * (events/events). This will help you get acquainted with the concepts involved.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/events).
 */
class Events
{

    /**
     * Get a list of events
     *
     * @param Client $client
     * @param \Ticketmatic\Model\EventQuery|array $params
     *
     * @throws ClientException
     *
     * @return EventsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new EventQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/events");

        $req->addQuery("context", $params->context);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("limit", $params->limit);
        $req->addQuery("offset", $params->offset);
        $req->addQuery("orderby", $params->orderby);
        $req->addQuery("output", $params->output);
        $req->addQuery("searchterm", $params->searchterm);
        $req->addQuery("simplefilter", $params->simplefilter);

        $result = $req->run("json");
        return EventsList::fromJson($result);
    }

    /**
     * Get a single event
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Event
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/events/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Event::fromJson($result);
    }

    /**
     * Create a new event
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Event|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Event
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Event($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/events");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Event::fromJson($result);
    }

    /**
     * Update an event
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Event|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Event
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Event($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Event::fromJson($result);
    }

    /**
     * Delete an event
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/events/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Get all tickets for an event
     *
     * Returns the list of all tickets that are part of this event.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\EventTicketQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketStream
     */
    public static function gettickets(Client $client, $id, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new EventTicketQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/events/{id}/tickets");
        $req->addParameter("id", $id);


        $req->addQuery("simplefilter", $params->simplefilter);

        $result = $req->stream("json");
        return new TicketStream($result);
    }

    /**
     * Batch update tickets for an event
     *
     * Update the contents of one or more custom fields for multiple tickets in one
     * call. Batch update is limited to 5000 tickets per call.
     *
     * **Warning:** Do not change the barcode of a ticket that has been delivered:
     * existing printed tickets will no longer work.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\EventTicket[]|array $data
     *
     * @throws ClientException
     */
    public static function batchupdatetickets(Client $client, $id, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new EventTicket($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}/tickets/batch");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Lock a set of tickets
     *
     * The lock call is limited to 100 tickets per call.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\EventLockTickets|array $data
     *
     * @throws ClientException
     */
    public static function locktickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new EventLockTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}/tickets/lock");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Unlock a set of tickets
     *
     * The unlock call is limited to 100 tickets per call.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\EventUnlockTickets|array $data
     *
     * @throws ClientException
     */
    public static function unlocktickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new EventUnlockTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}/tickets/unlock");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Update the seat rank for a set of tickets
     *
     * Updates the seat rank for tickets, works only for active events.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\EventUpdateSeatRankForTickets|array $data
     *
     * @throws ClientException
     */
    public static function updateseatrankfortickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new EventUpdateSeatRankForTickets($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}/tickets/seatrank");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/events/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return $result;
    }

    /**
     * Update translations
     *
     * @param Client $client
     * @param int $id
     * @param string[]|array $data
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translate(Client $client, $id, $data) {
        $req = $client->newRequest("PUT", "/{accountname}/events/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return $result;
    }
}
