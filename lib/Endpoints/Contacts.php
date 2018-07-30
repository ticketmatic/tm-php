<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
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

namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\BatchContactOperation;
use Ticketmatic\Model\Contact;
use Ticketmatic\Model\ContactGetQuery;
use Ticketmatic\Model\ContactIdReservation;
use Ticketmatic\Model\ContactImportStatus;
use Ticketmatic\Model\ContactQuery;

/**
 * Contact manipulation operations
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/contacts).
 */
class Contacts
{

    /**
     * Get a list of contacts
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ContactQuery|array $params
     *
     * @throws ClientException
     *
     * @return ContactsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new ContactQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/contacts");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("limit", $params->limit);
        $req->addQuery("offset", $params->offset);
        $req->addQuery("orderby", $params->orderby);
        $req->addQuery("output", $params->output);
        $req->addQuery("searchterm", $params->searchterm);

        $result = $req->run("json");
        return ContactsList::fromJson($result);
    }

    /**
     * Get a single contact
     *
     * To retrieve a contact based on the e-mail address, pass `0` as the id and supply
     * an `email` parameter.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\ContactGetQuery|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Contact
     */
    public static function get(Client $client, $id, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new ContactGetQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/contacts/{id}");
        $req->addParameter("id", $id);


        $req->addQuery("email", $params->email);

        $result = $req->run("json");
        return Contact::fromJson($result);
    }

    /**
     * Create a new contact
     *
     * Creates a new contact
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Contact|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Contact
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Contact($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/contacts");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Contact::fromJson($result);
    }

    /**
     * Update a contact
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Contact|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Contact
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Contact($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/contacts/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Contact::fromJson($result);
    }

    /**
     * Remove a contact
     *
     * Contacts are archivable: this call won't actually delete the object from the
     * database. Instead, it will mark the contact as deleted, which means it won't
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
        $req = $client->newRequest("DELETE", "/{accountname}/contacts/{id}");
        $req->addParameter("id", $id);


        $req->run("json");
    }

    /**
     * Batch operations
     *
     * Apply batch operations to a set of contacts.
     *
     * The parameters required are specific to the type of operation.
     *
     * ## What will be affected?
     *
     * If you don't specify anything, the batch operation will be applied to all
     * contacts.
     *
     * To restrict the operation to a strict set of contacts, pass in the IDs:
     *
     * ```
     * ids: [1, 2, 3]
     * ```
     *
     * This will only apply the operation to contacts with ID `1`, `2` and `3`.
     *
     * You can also apply the operation to all contacts except for a set of IDs, using
     * `excludeids`:
     *
     * ```
     * excludeids: [4, 5]
     * ```
     *
     * This will apply the operation to all contacts, except for contacts with ID `4`
     * and `5`.
     *
     * ## Batch operations
     *
     * The following operations are supported:
     *
     * * `addrelationtypes`: Adds the specified relation types to the selection of
     * contacts. The `parameters` object should contain an `ids` field with a set of
     * relation type IDs.
     *
     * * `removerelationtypes`: Remove the specified relation types from the selection
     * of contacts. The `parameters` object should contain an `ids` field with a set of
     * relation type IDs.
     *
     * * `delete`: Deletes the selection of contacts.
     *
     * * `subscribe`: Subscribes the selected contacts using the mailing tool.
     *
     * * `unsubscribe`: Unsubscribes the selected contacts using the mailing tool.
     *
     * * `sendselection`: Send a selection of contacts to the mailing tool. These
     * contacts can then be used to send out a mailing. The `parameters` object can
     * optionally contain a `name` field that will be used to identify the selection.
     *
     * * `update`: Update a specific field for the selection of contacts. See
     * BatchContactParameters (api/types/BatchContactParameters) for more info.
     *
     * * `merge`: Merges the selected contacts into a specified contact. The `primary`
     * parameter should be supplied to indicate which contact gets preference.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\BatchContactOperation|array $data
     *
     * @throws ClientException
     */
    public static function batch(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new BatchContactOperation($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/contacts/batch");
        $req->setBody($data, "json");

        $req->run("json");
    }

    /**
     * Import contact
     *
     * Up to 1000 contacts can be sent per call.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Contact[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactImportStatus[]
     */
    public static function import(Client $client, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new Contact($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("POST", "/{accountname}/contacts/import");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Json::unpackArray("ContactImportStatus", $result);
    }

    /**
     * Reserve contact IDs
     *
     * Importing contacts with the specified IDs is only possible when those IDs fall
     * in the reserved ID range. Use this call to reserve a range of contact IDs. Any
     * unused ID lower than or equal to the specified ID will be reserved. New contacts
     * will receive IDs higher than the specified ID.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ContactIdReservation|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ContactIdReservation
     */
    public static function reserve(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new ContactIdReservation($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/contacts/import/reserve");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return ContactIdReservation::fromJson($result);
    }
}
