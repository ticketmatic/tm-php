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

namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\LockType;
use Ticketmatic\Model\LockTypeQuery;

/**
 * When configuring an event, it is possible to reserve some tickets or make them
 * unavailable.
 *
 * Lock types define the ways how these tickets can be blocked.
 *
 * Some examples:
 *
 * * Seats unavailable due to technical reasons (e.g. a PA installation)
 *
 * * Reserved seats for people with limited mobility
 *
 * * An extra contingent of tickets that might be added later, but shouldn't be
 * sold right away
 *
 * For more info, check the event setup guide
 * (https://apps.ticketmatic.com/#/knowledgebase/setupexpert_events).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_locktypes).
 */
class Locktypes
{

    /**
     * Get a list of lock types
     *
     * @param Client $client
     * @param \Ticketmatic\Model\LockTypeQuery|array $params
     *
     * @throws ClientException
     *
     * @return LocktypesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new LockTypeQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/locktypes");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return LocktypesList::fromJson($result);
    }

    /**
     * Get a single lock type
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LockType
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return LockType::fromJson($result);
    }

    /**
     * Create a new lock type
     *
     * @param Client $client
     * @param \Ticketmatic\Model\LockType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LockType
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new LockType($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/locktypes");
        $req->setBody($data->jsonSerialize());

        $result = $req->run();
        return LockType::fromJson($result);
    }

    /**
     * Modify an existing lock type
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\LockType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LockType
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new LockType($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data->jsonSerialize());

        $result = $req->run();
        return LockType::fromJson($result);
    }

    /**
     * Remove a lock type
     *
     * Lock types are archivable: this call won't actually delete the object from the
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * See translations
     * (https://apps.ticketmatic.com/#/knowledgebase/api/coreconcepts_translations) for
     * more information.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/locktypes/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run();
        return $result;
    }

    /**
     * Update translations
     *
     * Sets updated translation strings.
     *
     * See translations
     * (https://apps.ticketmatic.com/#/knowledgebase/api/coreconcepts_translations) for
     * more information.
     *
     * @param Client $client
     * @param int $id
     * @param string[]|array $data
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translate(Client $client, $id, $data) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/locktypes/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data->jsonSerialize());

        $result = $req->run();
        return $result;
    }
}
