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
use Ticketmatic\Model\EventQuery;

/**
 * Before using events through the API, be sure to read the event setup guide
 * (https://apps.ticketmatic.com/#/knowledgebase/setupexpert_events). This will
 * help you get acquainted with the concepts involved.
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

        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("limit", $params->limit);
        $req->addQuery("offset", $params->offset);
        $req->addQuery("orderby", $params->orderby);
        $req->addQuery("output", $params->output);
        $req->addQuery("searchterm", $params->searchterm);
        $req->addQuery("simplefilter", $params->simplefilter);
        $req->addQuery("context", $params->context);

        $result = $req->run();
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


        $result = $req->run();
        return Event::fromJson($result);
    }
}
