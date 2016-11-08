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
 * Set of parameters used to filter web sales skins.
 *
 * More info: see web sales skin (api/types/WebSalesSkin), the getlist operation
 * (api/settings/communicationanddesign/webskins/getlist) and the web sales skins
 * endpoint (api/settings/communicationanddesign/webskins).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/WebSalesSkinQuery).
 */
class WebSalesSkinQuery implements \jsonSerializable
{
    /**
     * Create a new WebSalesSkinQuery
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Filter the returned items by specifying a query on the public datamodel that
     * returns the ids.
     *
     * @var string
     */
    public $filter;

    /**
     * All items that were updated since this timestamp will be returned. Timestamp
     * should be passed in `YYYY-MM-DD hh:mm:ss` format.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Unpack WebSalesSkinQuery from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\WebSalesSkinQuery
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new WebSalesSkinQuery(array(
            "filter" => isset($obj->filter) ? $obj->filter : null,
            "lastupdatesince" => isset($obj->lastupdatesince) ? Json::unpackTimestamp($obj->lastupdatesince) : null,
        ));
    }

    /**
     * Serialize WebSalesSkinQuery to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->filter)) {
            $result["filter"] = strval($this->filter);
        }
        if (!is_null($this->lastupdatesince)) {
            $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
        }

        return $result;
    }
}
