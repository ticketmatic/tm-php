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
use Ticketmatic\Model\OrderFee;
use Ticketmatic\Model\OrderFeeQuery;

/**
 * Order fees determine which extra costs or discounts can be added to an order.
 *
 * ## Types
 *
 * There are two types:
 *
 * * **Automatic (`2401`)** : Order fees of this type are added automatically to an
 * order if the order matches the rules of the orderfee. Rules can be matched based
 * on a saleschannel, deliveryscenario and/or paymentscenario.
 *
 * * **Script (`2402`)** : Order fees of this type consist of a piece of custom
 * javascript. When the order cost is evaluated, this javascript is executed and
 * the return value is added to the order.
 *
 * ### Automatic
 *
 * An automatic order fee can have multiple rules. The general rules should be
 * defined first and the exceptions later. Whenever the rules of an (automatic)
 * order fee are checked it will execute the last rule that matches.
 *
 * A match will occur if the order has a saleschannel, delivery scenario and
 * payment scenario that matches the OrderfeeAutoRule
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderfeeAutoRule). If
 * it's matched (and it is was the last rule that matched) the defined value will
 * be added, based on the status (`fixedfee` or `percentagefee`).
 *
 * ### Script
 *
 * An order fee of type script consists of a javascript. This javascript is always
 * executed and the number that is returned is added to the order amount. This
 * script has an order object available. You can find more info about writing order
 * scripts here
 * (https://apps.ticketmatic.com/#/knowledgebase/developer_writingorderscripts).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_orderfees).
 */
class Orderfees
{

    /**
     * Get a list of order fees
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderFeeQuery|array $params
     *
     * @throws ClientException
     *
     * @return OrderfeesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new OrderFeeQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/orderfees");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return OrderfeesList::fromJson($result);
    }

    /**
     * Get a single order fee
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderFee
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/orderfees/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderFee::fromJson($result);
    }

    /**
     * Create a new order fee
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderFee|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderFee
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new OrderFee($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/orderfees");
        $req->setBody($data->jsonSerialize());

        $result = $req->run();
        return OrderFee::fromJson($result);
    }

    /**
     * Remove an order fee
     *
     * Order fees are archivable: this call won't actually delete the object from the
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/orderfees/{id}");
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
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/orderfees/{id}/translate");
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/orderfees/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data->jsonSerialize());

        $result = $req->run();
        return $result;
    }
}
