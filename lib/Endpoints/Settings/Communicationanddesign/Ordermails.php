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

namespace Ticketmatic\Endpoints\Settings\Communicationanddesign;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\OrderMailTemplate;
use Ticketmatic\Model\OrderMailTemplateQuery;

/**
 * Order mail templates are used to construct e-mails sent to customers.
 *
 * Before working with order mail templates, be sure to read the order mail design
 * guide (https://apps.ticketmatic.com/#/knowledgebase/designer_ordermail).
 *
 * ## Types
 *
 * There are 5 types of order mail templates:
 *
 * * **Confirmation (`3101`)**
 *
 * * **Delivery (`3102`)**
 *
 * * **Payment instructions (`3103`)**
 *
 * * **Overdue notices (`3104`)**
 *
 * * **Expiration notices (`3105`)**
 *
 * ## Subject & Body
 *
 * Both the subject and body fields allow using Twig variables. These are described
 * in the order mail design guide
 * (https://apps.ticketmatic.com/#/knowledgebase/designer_ordermail).
 *
 * The body should contain a valid HTML document. Be sure to include a `charset`
 * definition:
 *
 * ```html
 * <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 * ```
 *
 * Any CSS embedded into the document header will be inlined for proper display in
 * mail clients.
 *
 * ## Translations
 *
 * Any HTML tag annotated with a `translate` attribute is considered translatable.
 *
 * These translations can be defined using the gettext
 * (http://en.wikipedia.org/wiki/Gettext) format. The `translations` field contains
 * a map with language codes as keys and `.po` files as their values.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ordermails).
 */
class Ordermails
{

    /**
     * Get a list of order mail templates
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderMailTemplateQuery|array $params
     *
     * @throws ClientException
     *
     * @return OrdermailsList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new OrderMailTemplateQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return OrdermailsList::fromJson($result);
    }

    /**
     * Get a single order mail template
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Create a new order mail template
     *
     * @param Client $client
     * @param \Ticketmatic\Model\OrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new OrderMailTemplate($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/communicationanddesign/ordermails");
        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Modify an existing order mail template
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\OrderMailTemplate|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\OrderMailTemplate
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new OrderMailTemplate($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return OrderMailTemplate::fromJson($result);
    }

    /**
     * Remove an order mail template
     *
     * Order mail templates are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/communicationanddesign/ordermails/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }
}
