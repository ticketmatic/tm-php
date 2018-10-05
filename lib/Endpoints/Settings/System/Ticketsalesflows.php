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
use Ticketmatic\Model\Flowinfo;
use Ticketmatic\Model\Flowsession;
use Ticketmatic\Model\Ticketsalesflow;
use Ticketmatic\Model\TicketsalesflowQuery;

/**
 * Ticket sales flows
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_ticketsalesflows).
 */
class Ticketsalesflows
{

    /**
     * Get a list of ticketsalesflows
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketsalesflowQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketsalesflowsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new TicketsalesflowQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/system/ticketsalesflows");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return TicketsalesflowsList::fromJson($result);
    }

    /**
     * Get a single ticketsalesflow
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalesflow
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/ticketsalesflows/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Ticketsalesflow::fromJson($result);
    }

    /**
     * Create a new ticketsalesflow
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Ticketsalesflow|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalesflow
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Ticketsalesflow($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/ticketsalesflows");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Ticketsalesflow::fromJson($result);
    }

    /**
     * Modify an existing ticketsalesflow
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Ticketsalesflow|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Ticketsalesflow
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Ticketsalesflow($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/ticketsalesflows/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Ticketsalesflow::fromJson($result);
    }

    /**
     * Remove a ticketsalesflow
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/system/ticketsalesflows/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Create a flow session
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Flowsession|array $data
     *
     * @throws ClientException
     *
     * @return string
     */
    public static function flowsession(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Flowsession($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/ticketsalesflows/flowsession");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return $result;
    }

    /**
     * Get info on a flow
     *
     * @param Client $client
     * @param string $token
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Flowinfo
     */
    public static function flowinfo(Client $client, $token) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/ticketsalesflows/flowinfo/{token}");
        $req->addParameter("token", $token);


        $result = $req->run("json");
        return Flowinfo::fromJson($result);
    }
}
