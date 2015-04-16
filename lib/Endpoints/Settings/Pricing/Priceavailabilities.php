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
use Ticketmatic\Model\CreatePriceAvailability;
use Ticketmatic\Model\PriceAvailability;
use Ticketmatic\Model\PriceAvailabilityParameters;
use Ticketmatic\Model\UpdatePriceAvailability;

/**
 * A price availability is a scheme that indicates which price types are available
 * for which saleschannel. A typical price availability might for example state
 * that price type "Standard" is available on all saleschanels, while price type
 * "Guest" is only available on the "Boxoffice" saleschannel.
 *
 * A price availability is selected for each event.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_priceavailabilities).
 */
class Priceavailabilities
{

    /**
     * Get a list of price availabilities
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PriceAvailabilityParameters|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ListPriceAvailability[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new PriceAvailabilityParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/priceavailabilities");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListPriceAvailability", $result);
    }

    /**
     * Get a single price availability
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceAvailability
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/priceavailabilities/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return PriceAvailability::fromJson($result);
    }

    /**
     * Create a new price availability
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreatePriceAvailability|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceAvailability
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreatePriceAvailability($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/pricing/priceavailabilities");
        $req->setBody($data);

        $result = $req->run();
        return PriceAvailability::fromJson($result);
    }

    /**
     * Modify an existing price availability
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdatePriceAvailability|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceAvailability
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdatePriceAvailability($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/priceavailabilities/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return PriceAvailability::fromJson($result);
    }

    /**
     * Remove a price availability
     *
     * Price availabilities are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/pricing/priceavailabilities/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
