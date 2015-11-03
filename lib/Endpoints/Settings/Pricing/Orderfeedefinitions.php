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
use Ticketmatic\Model\OrderFeeDefinition;
use Ticketmatic\Model\OrderFeeDefinitionQuery;

/**
 * Order fee definitions
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_orderfeedefinitions).
 */
class Orderfeedefinitions
{

    /**
     * Get a list of order fee definitions
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderFeeDefinitionQuery|array $params
     *
     * @throws ClientException
     *
     * @return OrderfeedefinitionsList
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new OrderFeeDefinitionQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/orderfeedefinitions");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return OrderfeedefinitionsList::fromJson($result);
    }

    /**
     * Get a single order fee definition
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderFeeDefinition
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/orderfeedefinitions/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderFeeDefinition::fromJson($result);
    }

    /**
     * Create a new order fee definition
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderFeeDefinition|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderFeeDefinition
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new OrderFeeDefinition($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/pricing/orderfeedefinitions");
        $req->setBody($data);

        $result = $req->run();
        return OrderFeeDefinition::fromJson($result);
    }

    /**
     * Remove an order fee definition
     *
     * Order fee definitions are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/pricing/orderfeedefinitions/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
