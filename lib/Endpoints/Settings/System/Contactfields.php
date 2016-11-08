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
use Ticketmatic\Model\ContactField;

/**
 * The contact fields list all fields that are asked when a contact is created. The
 * main purpose of exposing these fields is to allow translation of these fields
 * via the API.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_contactfields).
 */
class Contactfields
{

    /**
     * Get the contact fields
     *
     * Gets the contact fields
     *
     * @param Client $client
     *
     * @throws ClientException
     *
     * @return ContactfieldsList
     */
    public static function getlist(Client $client) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactfields");

        $result = $req->run();
        return ContactfieldsList::fromJson($result);
    }

    /**
     * Get the contact field
     *
     * Gets the contact field
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactField
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactfields/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return ContactField::fromJson($result);
    }

    /**
     * Get the translations for this field
     *
     * Get the translations for this field
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/contactfields/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run();
        return $result;
    }

    /**
     * Update the translations for this field
     *
     * Update the translations for this field
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/contactfields/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return $result;
    }
}
