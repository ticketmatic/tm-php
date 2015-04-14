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
use Ticketmatic\Model\CreateRevenueSplit;
use Ticketmatic\Model\RevenueSplit;
use Ticketmatic\Model\RevenueSplitParameters;
use Ticketmatic\Model\UpdateRevenueSplit;

/**
 * Revenue splits are schemes that define how the ticket revenue will be split
 * internally. In a revenue split scheme a split for each revenue split category is
 * defined. The split can either be a fixed amount or a percentage amount on the
 * ticket price.
 *
 * By linking a revenue split to an event, you define how the ticket revenue will
 * be split for that event. The same revenue split can be linked to multiple
 * events.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_revenuesplits).
 */
class Revenuesplits
{

    /**
     * Get a list of revenue splits
     *
     * @param Client $client
     * @param \Ticketmatic\Model\RevenueSplitParameters|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ListRevenueSplit[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new RevenueSplitParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/revenuesplits");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListRevenueSplit", $result);
    }

    /**
     * Get a single revenue split
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RevenueSplit
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/revenuesplits/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return RevenueSplit::fromJson($result);
    }

    /**
     * Create a new revenue split
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreateRevenueSplit|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RevenueSplit
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreateRevenueSplit($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/pricing/revenuesplits");
        $req->setBody($data);

        $result = $req->run();
        return RevenueSplit::fromJson($result);
    }

    /**
     * Modify an existing revenue split
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdateRevenueSplit|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RevenueSplit
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdateRevenueSplit($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/revenuesplits/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return RevenueSplit::fromJson($result);
    }

    /**
     * Remove a revenue split
     *
     * Revenue splits are archivable: this call won't actually delete the object from
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/pricing/revenuesplits/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify revenue splits
     *
     * @param Client $client
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/revenuesplits");

        $req->run();
    }
}
