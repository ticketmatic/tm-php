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

namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\WebSalesSkin;
use Ticketmatic\Model\WebSalesSkinQuery;

/**
 * Web sales skins define skins for the web sales interface.
 *
 * It consists of html and css. You can find more about designing web sales skins
 * here (tickets/configure_ticket_sales/webskin).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_webskins).
 */
class Webskins
{

    /**
     * Get a list of web sales skins
     *
     * @param Client $client
     * @param \Ticketmatic\Model\WebSalesSkinQuery|array $params
     *
     * @throws ClientException
     *
     * @return WebskinsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new WebSalesSkinQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/webskins");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return WebskinsList::fromJson($result);
    }

    /**
     * Get a single web sales skin
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WebSalesSkin
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Create a new web sales skin
     *
     * @param Client $client
     * @param \Ticketmatic\Model\WebSalesSkin|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WebSalesSkin
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new WebSalesSkin($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/webskins");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Modify an existing web sales skin
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\WebSalesSkin|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WebSalesSkin
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new WebSalesSkin($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return WebSalesSkin::fromJson($result);
    }

    /**
     * Remove a web sales skin
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/webskins/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }
}
