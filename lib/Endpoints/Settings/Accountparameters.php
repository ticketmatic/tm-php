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

namespace Ticketmatic\Endpoints\Settings;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\AccountParameter;

/**
 * Account parameters control central parameters related to your account.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_accountparameters).
 */
class Accountparameters
{

    /**
     * Get all configured account parameters
     *
     * @param Client $client
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AccountParameter[]
     */
    public static function getlist(Client $client) {
        $req = $client->newRequest("GET", "/{accountname}/settings/accountparameters");

        $result = $req->run("json");
        return Json::unpackArray("AccountParameter", $result);
    }

    /**
     * Get an account parameter
     *
     * @param Client $client
     * @param string $name
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AccountParameter
     */
    public static function get(Client $client, $name) {
        $req = $client->newRequest("GET", "/{accountname}/settings/accountparameters/{name}");
        $req->addParameter("name", $name);


        $result = $req->run("json");
        return AccountParameter::fromJson($result);
    }

    /**
     * Set an account parameter
     *
     * @param Client $client
     * @param \Ticketmatic\Model\AccountParameter|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\AccountParameter
     */
    public static function set(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new AccountParameter($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/accountparameters");
        $req->setBody($data, "json");

        $result = $req->run("json");
        return AccountParameter::fromJson($result);
    }
}
