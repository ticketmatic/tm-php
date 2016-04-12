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
use Ticketmatic\Model\FilterDefinition;
use Ticketmatic\Model\FilterDefinitionQuery;

/**
 * Filter definitions define filters that can be used in the backoffice.
 *
 * The field typeid defines to which object a filter definition belongs:
 *
 * * **10001**: order
 *
 * * **10002**: customer
 *
 * * **10003**: event
 *
 * * **10004**: ticket
 *
 * * **10005**: payment
 *
 * The field filtertype defines the kind of filter:
 *
 * * **0**: Toggle
 *
 * * **1**: Checklist
 *
 * * **2**: Date range
 *
 * * **5**: String
 *
 * * **6**: Number range
 *
 * * **9**: Tickets bought
 *
 * * **10**: Option set
 *
 * The field sqlclause defines the actual filter
 *
 * You can find more information about setting up filter definitions here
 * (https://apps.ticketmatic.com/#/knowledgebase/developer_filterdefinitions)
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions).
 */
class Filterdefinitions
{

    /**
     * Get a list of filter definitions
     *
     * @param Client $client
     * @param \Ticketmatic\Model\FilterDefinitionQuery|array $params
     *
     * @throws ClientException
     *
     * @return FilterdefinitionsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new FilterDefinitionQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/system/filterdefinitions");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("typeid", $params->typeid);

        $result = $req->run();
        return FilterdefinitionsList::fromJson($result);
    }

    /**
     * Get a single filter definition
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\FilterDefinition
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/system/filterdefinitions/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return FilterDefinition::fromJson($result);
    }

    /**
     * Create a new filter definition
     *
     * @param Client $client
     * @param \Ticketmatic\Model\FilterDefinition|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\FilterDefinition
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new FilterDefinition($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/system/filterdefinitions");
        $req->setBody($data);

        $result = $req->run();
        return FilterDefinition::fromJson($result);
    }

    /**
     * Modify an existing filter definition
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\FilterDefinition|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\FilterDefinition
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new FilterDefinition($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/filterdefinitions/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return FilterDefinition::fromJson($result);
    }

    /**
     * Remove a filter definition
     *
     * Filter definitions are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/system/filterdefinitions/{id}");
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
        $req = $client->newRequest("GET", "/{accountname}/settings/system/filterdefinitions/{id}/translate");
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/system/filterdefinitions/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return $result;
    }
}
