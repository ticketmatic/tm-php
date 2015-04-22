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

namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\Order;
use Ticketmatic\Model\OrderQuery;

class Orders
{

    /**
     * Get a list of orders
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderQuery|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new OrderQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/orders");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("limit", $params->limit);
        $req->addQuery("offset", $params->offset);
        $req->addQuery("orderby", $params->orderby);
        $req->addQuery("output", $params->output);
        $req->addQuery("searchterm", $params->searchterm);
        $req->addQuery("simplefilter", $params->simplefilter);

        $result = $req->run();
        return Json::unpackArray("Order", $result);
    }

    /**
     * Get a single order
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/orders/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return Order::fromJson($result);
    }

    /**
     * Add tickets to order
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Ticket[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function addtickets(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new Ticket[]($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/orders/{id}/tickets");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Order::fromJson($result);
    }
}
