<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Endpoints\Settings\System;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\Ticketsalessetup;
use Ticketmatic\Model\TicketsalessetupQuery;

/**
 * Ticket sales setup
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_ticketsalessetups).
 */
class Ticketsalessetups
{

    /**
     * Get a list of ticketsalessetups
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketsalessetupQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketsalessetupsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new TicketsalessetupQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/system/ticketsalessetups");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return TicketsalessetupsList::fromJson($result);
    }

    /**
     * Get a single ticketsalessetup
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalessetup
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/ticketsalessetups/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Ticketsalessetup::fromJson($result);
    }

    /**
     * Create a new ticketsalessetup
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Ticketsalessetup|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalessetup
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Ticketsalessetup($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/ticketsalessetups");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Ticketsalessetup::fromJson($result);
    }

    /**
     * Modify an existing ticketsalessetup
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Ticketsalessetup|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalessetup
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Ticketsalessetup($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/ticketsalessetups/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Ticketsalessetup::fromJson($result);
    }

    /**
     * Remove a ticketsalessetup
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/system/ticketsalessetups/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }
}
