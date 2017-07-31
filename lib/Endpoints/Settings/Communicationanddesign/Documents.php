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

namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\Document;
use Ticketmatic\Model\DocumentQuery;

/**
 * Ticketmatic allows you to create documents for contacts and orders, you can read
 * more in this article (setup/document)
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_documents).
 */
class Documents
{

    /**
     * Get a list of documents
     *
     * @param Client $client
     * @param \Ticketmatic\Model\DocumentQuery|array $params
     *
     * @throws ClientException
     *
     * @return DocumentsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new DocumentQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/documents");

        $req->addQuery("typeid", $params->typeid);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run("json");
        return DocumentsList::fromJson($result);
    }

    /**
     * Get a single document
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Document
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/documents/{id}");
        $req->addParameter("id", $id);


        $result = $req->run("json");
        return Document::fromJson($result);
    }

    /**
     * Create a new document
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Document|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Document
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Document($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/documents");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return Document::fromJson($result);
    }

    /**
     * Modify an existing document
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Document|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Document
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Document($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/documents/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return Document::fromJson($result);
    }

    /**
     * Remove a document
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/documents/{id}");
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
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/documents/{id}/translate");
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/documents/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data, "json");

        $result = $req->run("json");
        return $result;
    }
}
