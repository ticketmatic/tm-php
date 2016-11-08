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

namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\TicketLayout;
use Ticketmatic\Model\TicketLayoutQuery;

/**
 * Ticket layouts define the list of layouts that can be used for tickets.
 *
 * Each ticketlayout has a number of ticketlayouttemplates, where the actual html
 * and css is defined.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ticketlayouts).
 */
class Ticketlayouts
{

    /**
     * Get a list of ticket layouts
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketLayoutQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketlayoutsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new TicketLayoutQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ticketlayouts");

        $req->addQuery("typeid", $params->typeid);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run();
        return TicketlayoutsList::fromJson($result);
    }

    /**
     * Get a single ticket layout
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayout
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ticketlayouts/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return TicketLayout::fromJson($result);
    }

    /**
     * Create a new ticket layout
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketLayout|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayout
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new TicketLayout($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/ticketlayouts");
        $req->setBody($data);

        $result = $req->run();
        return TicketLayout::fromJson($result);
    }

    /**
     * Modify an existing ticket layout
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketLayout|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayout
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new TicketLayout($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ticketlayouts/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return TicketLayout::fromJson($result);
    }

    /**
     * Remove a ticket layout
     *
     * Ticket layouts are archivable: this call won't actually delete the object from
     * the database. Instead, it will mark the object as archived, which means it won't
     * show up anymore in most places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure
     * consistency of historical data.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/ticketlayouts/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
