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
 * Product price
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ProductPrice).
 */
class ProductPrice implements \jsonSerializable
{
    /**
     * Create a new ProductPrice
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Default price
     *
     * @var float
     */
    public $default;

    /**
     * Exceptions on the default price
     *
     * @var \Ticketmatic\Model\ProductPriceException[]
     */
    public $exceptions;

    /**
     * Unpack ProductPrice from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ProductPrice
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ProductPrice(array(
            "default" => isset($obj->default) ? $obj->default : null,
            "exceptions" => isset($obj->exceptions) ? Json::unpackArray("ProductPriceException", $obj->exceptions) : null,
        ));
    }

    /**
     * Serialize ProductPrice to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->default)) {
            $result["default"] = floatval($this->default);
        }
        if (!is_null($this->exceptions)) {
            $result["exceptions"] = $this->exceptions;
        }

        return $result;
    }
}
