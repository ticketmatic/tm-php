<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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
use Ticketmatic\Model\TicketLayoutTemplate;
use Ticketmatic\Model\TicketLayoutTemplateQuery;

/**
 * Ticket layout templates define a specific template (with a specific size) for a
 * layout.
 *
 * It consists of html and css and is linked to specific deliveryscenarios. You can
 * find more about designing ticket layouts here
 * (https://apps.ticketmatic.com/#/knowledgebase/designer_ticketlayout).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ticketlayouttemplates).
 */
class Ticketlayouttemplates
{

    /**
     * Get a list of ticket layout templates
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketLayoutTemplateQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketlayouttemplatesList
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new TicketLayoutTemplateQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ticketlayouttemplates");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("typeid", $params->typeid);

        $result = $req->run();
        return TicketlayouttemplatesList::fromJson($result);
    }

    /**
     * Get a single ticket layout template
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayoutTemplate
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ticketlayouttemplates/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return TicketLayoutTemplate::fromJson($result);
    }

    /**
     * Create a new ticket layout template
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketLayoutTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayoutTemplate
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new TicketLayoutTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/ticketlayouttemplates");
        $req->setBody($data);

        $result = $req->run();
        return TicketLayoutTemplate::fromJson($result);
    }

    /**
     * Modify an existing ticket layout template
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketLayoutTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketLayoutTemplate
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new TicketLayoutTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ticketlayouttemplates/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return TicketLayoutTemplate::fromJson($result);
    }

    /**
     * Remove a ticket layout template
     *
     * Ticket layout templates are archivable: this call won't actually delete the
     * object from the database. Instead, it will mark the object as archived, which
     * means it won't show up anymore in most places.
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/ticketlayouttemplates/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
