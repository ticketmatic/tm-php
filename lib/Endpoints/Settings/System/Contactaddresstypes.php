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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Endpoints\Settings\System;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\ContactAddressType;
use Ticketmatic\Model\ContactAddressTypeQuery;

/**
 * Address types allow you to attach a type to different addresses.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_contactaddresstypes).
 */
class Contactaddresstypes
{

    /**
     * Get a list of contact address types
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ContactAddressTypeQuery|array $params
     *
     * @throws ClientException
     *
     * @return ContactaddresstypesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new ContactAddressTypeQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactaddresstypes");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return ContactaddresstypesList::fromJson($result);
    }

    /**
     * Get a single contact address type
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactAddressType
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactaddresstypes/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return ContactAddressType::fromJson($result);
    }

    /**
     * Create a new contact address type
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ContactAddressType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactAddressType
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new ContactAddressType($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/contactaddresstypes");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return ContactAddressType::fromJson($result);
    }

    /**
     * Modify an existing contact address type
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\ContactAddressType|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactAddressType
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new ContactAddressType($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/contactaddresstypes/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return ContactAddressType::fromJson($result);
    }

    /**
     * Remove a contact address type
     *
     * Contact address types are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/system/contactaddresstypes/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * See translations (api/coreconcepts/translations) for more information.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactaddresstypes/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return $result;
    }

    /**
     * Update translations
     *
     * Sets updated translation strings.
     *
     * See translations (api/coreconcepts/translations) for more information.
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/contactaddresstypes/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return $result;
    }
}
