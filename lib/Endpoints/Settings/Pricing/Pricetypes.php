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
use Ticketmatic\Model\CreatePriceType;
use Ticketmatic\Model\PriceType;
use Ticketmatic\Model\PriceTypeParameters;
use Ticketmatic\Model\UpdatePriceType;

/**
 * Pricetypes describe the different types of prices that exist for an event, for example
 * "Standard", "Reduction -26", "Guest" or "VIP". Pricetypes are used in pricelists to define
 * actual prices. Pricetypes are global for the account. Pricetypes are themselves categorized in:
 *
 * * Normal (id 2302)
 *
 * * Reduction (id 2302)
 *
 * * Special (id 2303)
 *
 * * Free (id 2304)
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricetypes).
 */
class Pricetypes
{

    /**
     * Get a list of price types
     *
     * @param Client $client
     * @param \Ticketmatic\Model\PriceTypeParameters|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ListPriceType[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new PriceTypeParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/pricetypes");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListPriceType", $result);
    }

    /**
     * Get a single price type
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceType
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/pricing/pricetypes/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return PriceType::fromJson($result);
    }

    /**
     * Create a new price type
     *
     * @param Client $client
     * @param \Ticketmatic\Model\CreatePriceType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceType
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreatePriceType($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/pricing/pricetypes");
        $req->setBody($data);

        $result = $req->run();
        return PriceType::fromJson($result);
    }

    /**
     * Modify an existing price type
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\UpdatePriceType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\PriceType
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdatePriceType($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/pricetypes/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return PriceType::fromJson($result);
    }

    /**
     * Remove a price type
     *
     * Price types are archivable: this call won't actually delete the object from the database.
     * Instead, it will mark the object as archived, which means it won't show up anymore in most
     * places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure consistency of
     * historical data.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/pricing/pricetypes/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify price types
     *
     * @param Client $client
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/pricing/pricetypes");

        $req->run();
    }
}
