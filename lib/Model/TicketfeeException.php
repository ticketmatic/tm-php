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
 * An exception to the default rule for a specific pricetype and a set of
 * saleschannels.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/TicketfeeException).
 */
class TicketfeeException implements \jsonSerializable
{
    /**
     * Create a new TicketfeeException
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The pricetype for which this exception is active.
     *
     * @var int
     */
    public $pricetypeid;

    /**
     * The set of rules (one for each saleschannel).
     *
     * @var \Ticketmatic\Model\TicketfeeSaleschannelRule[]
     */
    public $saleschannels;

    /**
     * Unpack TicketfeeException from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\TicketfeeException
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new TicketfeeException(array(
            "pricetypeid" => isset($obj->pricetypeid) ? $obj->pricetypeid : null,
            "saleschannels" => isset($obj->saleschannels) ? Json::unpackArray("TicketfeeSaleschannelRule", $obj->saleschannels) : null,
        ));
    }

    /**
     * Serialize TicketfeeException to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->pricetypeid)) {
            $result["pricetypeid"] = intval($this->pricetypeid);
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }

        return $result;
    }
}
