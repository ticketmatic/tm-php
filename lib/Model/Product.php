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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * A single product.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_products/get) and the
 * products endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_products).
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
     * Unique 12-digit for the product
     *
     * @var string
     */
    public $code;

    /**
     * Name for the product
     *
     * @var string
     */
    public $name;

    /**
     * Description for the product
     *
     * @var string
     */
    public $description;

    /**
     * Category for the product
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
     * Definition of possible properties for the product
     *
     * @var \Ticketmatic\Model\ProductProperty[]
     */
    public $properties;

    /**
     * Definition of the values for an instance of the product. These depend on the
     * properties
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var \Ticketmatic\Model\ProductInstancevalues
     */
    public $instancevalues;

    /**
     * Start of sales
     *
     * @var \DateTime
     */
    public $salestartts;

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
     * Translations for the product properties
     *
     * **Note:** Not set when retrieving a list of products.
     *
     * @var string[]
     */
    public $translations;

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
            "code" => isset($obj->code) ? $obj->code : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "categoryid" => isset($obj->categoryid) ? $obj->categoryid : null,
            "layoutid" => isset($obj->layoutid) ? $obj->layoutid : null,
            "properties" => isset($obj->properties) ? Json::unpackArray("ProductProperty", $obj->properties) : null,
            "instancevalues" => isset($obj->instancevalues) ? ProductInstancevalues::fromJson($obj->instancevalues) : null,
            "salestartts" => isset($obj->salestartts) ? Json::unpackTimestamp($obj->salestartts) : null,
            "saleendts" => isset($obj->saleendts) ? Json::unpackTimestamp($obj->saleendts) : null,
            "saleschannels" => isset($obj->saleschannels) ? $obj->saleschannels : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
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
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->categoryid)) {
            $result["categoryid"] = intval($this->categoryid);
        }
        if (!is_null($this->layoutid)) {
            $result["layoutid"] = intval($this->layoutid);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }
        if (!is_null($this->instancevalues)) {
            $result["instancevalues"] = $this->instancevalues;
        }
        if (!is_null($this->salestartts)) {
            $result["salestartts"] = Json::packTimestamp($this->salestartts);
        }
        if (!is_null($this->saleendts)) {
            $result["saleendts"] = Json::packTimestamp($this->saleendts);
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }

        return $result;
    }
}
