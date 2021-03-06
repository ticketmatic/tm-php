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
use Ticketmatic\Model\AccountInfo;
use Ticketmatic\Model\QueryRequest;
use Ticketmatic\Model\QueryResult;
use Ticketmatic\Model\TicketsprocessedRequest;
use Ticketmatic\Model\TicketsprocessedStatistics;

/**
 * Miscellaneous tools for retrieving information from the account.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/tools).
 */
class Tools
{

    /**
     * Get account information
     *
     * Get information of the current account, can be used to retrieve account details
     * such as the account ID and the full name.
     *
     * @param Client $client
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AccountInfo
     */
    public static function account(Client $client) {
        $req = $client->newRequest("GET", "/{accountname}/tools/account");

        $result = $req->run("json");
        return AccountInfo::fromJson($result);
    }

    /**
     * Get authorized accounts
     *
     * Gets an overview of all authorized accounts for this API key.
     *
     * Note: This API method is not specific to an account. You should make a separate
     * API client and use an empty string (`""`) as the account shortname.
     *
     * @param Client $client
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AccountInfo[]
     */
    public static function accounts(Client $client) {
        $req = $client->newRequest("GET", "/_/tools/accounts");

        $result = $req->run("json");
        return Json::unpackArray("AccountInfo", $result);
    }

    /**
     * Execute a query on the public data model
     *
     * Use this method to execute random (read-only) queries on the public data model.
     * Note that this is not meant for long-running queries or for returning large
     * resultsets. If the query executes too long or uses too much memory, an exception
     * will be returned.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\QueryRequest|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\QueryResult
     */
    public static function queries(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new QueryRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/tools/queries");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return QueryResult::fromJson($result);
    }

    /**
     * Export a query on the public data model
     *
     * Executes a query against the public data model and exports the results as a
     * stream of JSON lines (http://jsonlines.org/): each line contains a JSON object
     * which holds one row of the query result.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\QueryRequest|array $data
     *
     * @throws ClientException
     *
     * @return QueryStream
     */
    public static function export(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new QueryRequest($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/tools/queries/export");
        $req->setBody($data, "json");

        $result = $req->stream("json");
        return new QueryStream($result);
    }

    /**
     * Get statistics on the tickets processed during a certain period
     *
     * Use this method to retrieve the statistics on the number of tickets processed
     * and sold online during a certain period. The results can be grouped by day or
     * month. These statistics are often used as basis for invoicing or reporting.
     *
     * @param Client $client
     * @param \Ticketmatic\Model\TicketsprocessedRequest|array $params
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\TicketsprocessedStatistics[]
     */
    public static function ticketsprocessedstatistics(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new TicketsprocessedRequest($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/tools/ticketsprocessedstatistics");

        $req->addQuery("endts", $params->endts);
        $req->addQuery("groupby", $params->groupby);
        $req->addQuery("startts", $params->startts);

        $result = $req->run("json");
        return Json::unpackArray("TicketsprocessedStatistics", $result);
    }
}
