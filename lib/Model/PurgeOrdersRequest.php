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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Info for requesting a purge of all orders.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PurgeOrdersRequest).
 */
class PurgeOrdersRequest implements \jsonSerializable
{
    /**
     * Create a new PurgeOrdersRequest
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Also purge contacts
     *
     * @var bool
     */
    public $contacts;

    /**
     * Only purge orders created since this timestamp
     *
     * @var string
     */
    public $createdsince;

    /**
     * Also purge events (incl. vouchers, products and bundles)
     *
     * @var bool
     */
    public $events;

    /**
     * Unpack PurgeOrdersRequest from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PurgeOrdersRequest
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PurgeOrdersRequest(array(
            "contacts" => isset($obj->contacts) ? $obj->contacts : null,
            "createdsince" => isset($obj->createdsince) ? $obj->createdsince : null,
            "events" => isset($obj->events) ? $obj->events : null,
        ));
    }

    /**
     * Serialize PurgeOrdersRequest to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->contacts)) {
            $result["contacts"] = (bool)$this->contacts;
        }
        if (!is_null($this->createdsince)) {
            $result["createdsince"] = strval($this->createdsince);
        }
        if (!is_null($this->events)) {
            $result["events"] = (bool)$this->events;
        }

        return $result;
    }
}
