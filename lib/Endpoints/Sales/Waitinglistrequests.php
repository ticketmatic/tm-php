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

namespace Ticketmatic\Endpoints\Sales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\WaitingListRequest;
use Ticketmatic\Model\WaitingListRequestQuery;

/**
 * Waiting list requests are used to show interest in events when tickets aren't
 * available.
 *
 * ## Itemsstatus
 *
 * The itemsstatus is used to indicate whether or not the related waiting list
 * request items provide the necessary information to transform the request into an
 * order.
 *
 * There are 3 possible itemsstatus values:
 *
 * * **No information provided (`29101`)**
 *
 * * **Partial information provided (`29102`)**
 *
 * * **Full information provided (`29103`)**
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/sales_waitinglistrequests).
 */
class Waitinglistrequests
{

    /**
     * Get a list of waiting list requests
     *
     * @param Client $client
     * @param \Ticketmatic\Model\WaitingListRequestQuery|array $params
     *
     * @throws ClientException
     *
     * @return WaitinglistrequestsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new WaitingListRequestQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/sales/waitinglistrequests");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return WaitinglistrequestsList::fromJson($result);
    }

    /**
     * Get a single waiting list request
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WaitingListRequest
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/sales/waitinglistrequests/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return WaitingListRequest::fromJson($result);
    }

    /**
     * Create a new waiting list request
     *
     * @param Client $client
     * @param \Ticketmatic\Model\WaitingListRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WaitingListRequest
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new WaitingListRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/sales/waitinglistrequests");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return WaitingListRequest::fromJson($result);
    }

    /**
     * Modify an existing waiting list request
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\WaitingListRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\WaitingListRequest
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new WaitingListRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/sales/waitinglistrequests/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return WaitingListRequest::fromJson($result);
    }

    /**
     * Remove a waiting list request
     *
     * Waiting list requests are archivable: this call won't actually delete the object
     * from the database. Instead, it will mark the object as archived, which means it
     * won't show up anymore in most places.
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
        $req = $client->newRequest("DELETE", "/{accountname}/sales/waitinglistrequests/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }
}
