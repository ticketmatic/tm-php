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

namespace Ticketmatic\Endpoints\Settings;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\ProductCategory;
use Ticketmatic\Model\ProductCategoryQuery;

/**
 * Each product belongs to a product category. A product category is used to define
 * the name of the product item and the name of the contact that is owner or holder
 * of the product.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_productcategories).
 */
class Productcategories
{

    /**
     * Get a list of product categories
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ProductCategoryQuery|array $params
     *
     * @throws ClientException
     *
     * @return ProductcategoriesList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new ProductCategoryQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/productcategories");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run();
        return ProductcategoriesList::fromJson($result);
    }

    /**
     * Get a single product category
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ProductCategory
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/productcategories/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return ProductCategory::fromJson($result);
    }

    /**
     * Create a new product category
     *
     * @param Client $client
     * @param \Ticketmatic\Model\ProductCategory|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ProductCategory
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new ProductCategory($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/productcategories");
        $req->setBody($data);

        $result = $req->run();
        return ProductCategory::fromJson($result);
    }

    /**
     * Modify an existing product category
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\ProductCategory|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\ProductCategory
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new ProductCategory($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/productcategories/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return ProductCategory::fromJson($result);
    }

    /**
     * Remove a product category
     *
     * Product categories are archivable: this call won't actually delete the object
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/productcategories/{id}");
        $req->addParameter("id", $id);


        $req->run();
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
        $req = $client->newRequest("GET", "/{accountname}/settings/productcategories/{id}/translate");
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
     * (https://apps.ticketmatic.com/#/knowledgebase/api/coreconcepts/translations) for
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
        $req = $client->newRequest("PUT", "/{accountname}/settings/productcategories/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return $result;
    }
}
