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
use Ticketmatic\Model\CreateOrderMailTemplate;
use Ticketmatic\Model\OrderMailTemplate;
use Ticketmatic\Model\OrderMailTemplateParameters;
use Ticketmatic\Model\UpdateOrderMailTemplate;

class Ordermails
{

    /**
     * Get a list of order mail templates
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderMailTemplateParameters|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ListOrderMailTemplate[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new OrderMailTemplateParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListOrderMailTemplate", $result);
    }

    /**
     * Get a single order mail template
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Create a new order mail template
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreateOrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateOrderMailTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/ordermails");
        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Modify an existing order mail template
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdateOrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateOrderMailTemplate($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Remove an order mail template
     *
     * Order mail templates are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify order mail templates
     *
     * @param Client $client
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ordermails");

        $req->run();
    }
}
