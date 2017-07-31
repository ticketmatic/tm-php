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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * A single product.
 *
 * More info: see the get operation (api/settings/products/get) and the products
 * endpoint (api/settings/products).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Product).
 */
class Product implements \jsonSerializable
{
    /**
     * Create a new Product
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new product.
     *
     * **Note:** Ignored when updating an existing product.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing product.
     *
     * @var int
     */
    public $typeid;

    /**
     * Category for the product. Categories can be managed in account parameters and
     * indicate the labels for a single and multiple product and also what labels to
     * use for the holders of the product. If not set, the UI will fallback to default
     * labels.
     *
     * @var int
     */
    public $categoryid;

    /**
     * Optional layout for the product. If not specified, there will be no ticket
     * generated for the product
     *
     * @var int
     */
    public $layoutid;

    /**
     * Name for the product
     *
     * @var string
     */
    public $name;

    /**
     * Unique 12-digit for the product
     *
     * @var string
     */
    public $code;

    /**
     * Description for the product
     *
     * @var string
     */
    public $description;

    /**
     * Instancevalues control the price for a product and for non simple products it
     * also controls the content of the product. All products should have a default
     * instancevalue and a set of exceptions (if there are any). If no specific
     * exception is found for the selected product, the default instancevalue is used.
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var \Ticketmatic\Model\ProductInstancevalues
     */
    public $instancevalues;

    /**
     * The amount of individual tickets per event that can be purchased alongside this
     * bundle.
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var int
     */
    public $maxadditionaltickets;

    /**
     * If true, tickets for items that belong to the product will be printed when
     * printing the product.
     *
     * @var bool
     */
    public $printtickets;

    /**
     * Definition of possible properties for the product. A product can have one or
     * more properties. Properties can be used to introduce variants of a product
     * (sizes of a t-shirt for example).
     *
     * @var \Ticketmatic\Model\ProductProperty[]
     */
    public $properties;

    /**
     * Queue ID
     *
     * See rate limiting (api/ratelimiting) for more info.
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var int
     */
    public $queuetoken;

    /**
     * End of sales
     *
     * @var \DateTime
     */
    public $saleendts;

    /**
     * Sales is active for these saleschannels
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var int[]
     */
    public $saleschannels;

    /**
     * Start of sales
     *
     * @var \DateTime
     */
    public $salestartts;

    /**
     * Translations for the product properties
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var string[]
     */
    public $translations;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new product.
     *
     * **Note:** Ignored when updating an existing product.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new product.
     *
     * **Note:** Ignored when updating an existing product.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new product.
     *
     * **Note:** Ignored when updating an existing product.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack Product from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Product
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Product(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "categoryid" => isset($obj->categoryid) ? $obj->categoryid : null,
            "layoutid" => isset($obj->layoutid) ? $obj->layoutid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "instancevalues" => isset($obj->instancevalues) ? ProductInstancevalues::fromJson($obj->instancevalues) : null,
            "maxadditionaltickets" => isset($obj->maxadditionaltickets) ? $obj->maxadditionaltickets : null,
            "printtickets" => isset($obj->printtickets) ? $obj->printtickets : null,
            "properties" => isset($obj->properties) ? Json::unpackArray("ProductProperty", $obj->properties) : null,
            "queuetoken" => isset($obj->queuetoken) ? $obj->queuetoken : null,
            "saleendts" => isset($obj->saleendts) ? Json::unpackTimestamp($obj->saleendts) : null,
            "saleschannels" => isset($obj->saleschannels) ? $obj->saleschannels : null,
            "salestartts" => isset($obj->salestartts) ? Json::unpackTimestamp($obj->salestartts) : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize Product to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->categoryid)) {
            $result["categoryid"] = intval($this->categoryid);
        }
        if (!is_null($this->layoutid)) {
            $result["layoutid"] = intval($this->layoutid);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->instancevalues)) {
            $result["instancevalues"] = $this->instancevalues;
        }
        if (!is_null($this->maxadditionaltickets)) {
            $result["maxadditionaltickets"] = intval($this->maxadditionaltickets);
        }
        if (!is_null($this->printtickets)) {
            $result["printtickets"] = (bool)$this->printtickets;
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }
        if (!is_null($this->queuetoken)) {
            $result["queuetoken"] = intval($this->queuetoken);
        }
        if (!is_null($this->saleendts)) {
            $result["saleendts"] = Json::packTimestamp($this->saleendts);
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }
        if (!is_null($this->salestartts)) {
            $result["salestartts"] = Json::packTimestamp($this->salestartts);
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
