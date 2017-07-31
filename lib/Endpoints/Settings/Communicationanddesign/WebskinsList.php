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

use Ticketmatic\Json;

/**
 * List results
 */
class WebskinsList
{
    /**
     * Create a new WebskinsList
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Result data
     *
     * @var \Ticketmatic\Model\WebSalesSkin[] $data
     */
    public $data;

    /**
     * The total number of results that are available without considering limit and offset, useful for paging.
     *
     * @var int $nbrofresults
     */
    public $nbrofresults;

    /**
     * Unpack WebskinsList from JSON.
     *
     * @param object $obj
     *
     * @return WebskinsList
     */
    public static function fromJson($obj) {
        return new WebskinsList(array(
            "data" => Json::unpackArray("WebSalesSkin", $obj->data),
            "nbrofresults" => isset($obj->nbrofresults) ? intval($obj->nbrofresults) : 0,
        ));
    }
}
