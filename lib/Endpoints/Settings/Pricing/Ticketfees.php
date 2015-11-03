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

namespace Ticketmatic\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\TicketFee;
use Ticketmatic\Model\TicketFeeQuery;

/**
 * Ticket fees are schemes that define what fee will be added to the ticket price,
 * depending on the price type and the sales channel used when the ticket is sold.
 * The fee can either be a fixed cost or a percentage cost.
 *
 * By linking a ticketfee scheme to an event, the fees that will be applied to
 * tickets for that event are defined. The same ticket fee can be linked to
 * multiple events. Changing a ticket fee scheme will automatically update this for
 * all linked events (the new fees will only be applied for new orders, fees for
 * tickets that are already sold will not change).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_ticketfees).
 */
class Ticketfees
{

    /**
     * Get a list of ticket fees
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketFeeQuery|array $params
     *
     * @throws ClientException
     *
     * @return TicketfeesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new TicketFeeQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/ticketfees");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return TicketfeesList::fromJson($result);
    }

    /**
     * Get a single ticket fee
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketFee
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/ticketfees/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return TicketFee::fromJson($result);
    }

    /**
     * Create a new ticket fee
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketFee|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketFee
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new TicketFee($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/pricing/ticketfees");
        $req->setBody($data);

        $result = $req->run();
        return TicketFee::fromJson($result);
    }

    /**
     * Modify an existing ticket fee
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\TicketFee|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketFee
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new TicketFee($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/ticketfees/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return TicketFee::fromJson($result);
    }

    /**
     * Remove a ticket fee
     *
     * Ticket fees are archivable: this call won't actually delete the object from the
     * database. Instead, it will mark the object as archived, which means it won't
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/pricing/ticketfees/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
