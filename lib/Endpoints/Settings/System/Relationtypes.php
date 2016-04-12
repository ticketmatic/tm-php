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

namespace Ticketmatic\Endpoints\Settings\System;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\RelationType;
use Ticketmatic\Model\RelationTypeQuery;

/**
 * Relation types can be used to introduce a hierarchy of contacts.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_relationtypes).
 */
class Relationtypes
{

    /**
     * Get a list of relation types
     *
     * @param Client $client
     * @param \Ticketmatic\Model\RelationTypeQuery|array $params
     *
     * @throws ClientException
     *
     * @return RelationtypesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new RelationTypeQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/system/relationtypes");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return RelationtypesList::fromJson($result);
    }

    /**
     * Get a single relation type
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RelationType
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/relationtypes/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return RelationType::fromJson($result);
    }

    /**
     * Create a new relation type
     *
     * @param Client $client
     * @param \Ticketmatic\Model\RelationType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RelationType
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new RelationType($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/relationtypes");
        $req->setBody($data);

        $result = $req->run();
        return RelationType::fromJson($result);
    }

    /**
     * Modify an existing relation type
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\RelationType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\RelationType
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new RelationType($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/relationtypes/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return RelationType::fromJson($result);
    }

    /**
     * Remove a relation type
     *
     * Relation types are archivable: this call won't actually delete the object from
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/system/relationtypes/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/relationtypes/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run();
        return $result;
    }

    /**
     * Update translations
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/relationtypes/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return $result;
    }
}
