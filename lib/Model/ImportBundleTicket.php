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
 * Used when importing an order with optiondbundle tickets
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ImportBundleTicket).
 */
class ImportBundleTicket implements \jsonSerializable
{
    /**
     * Create a new ImportBundleTicket
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Manually select a specific ticket.
     *
     * @var int
     */
    public $id;

    /**
     * If boolean is set to true, the price field is used (even if set to 0) to
     * determine the price for this ticket
     *
     * @var bool
     */
    public $overrideprice;

    /**
     * The price for this bundle ticket, if this value is greater than 0 it's always
     * used. If one of the bundletickets has a price, all bundletickets should have a
     * price. Setting this overrides the default behaviour of the configured bundle.
     *
     * @var float
     */
    public $price;

    /**
     * Seatzone ID
     *
     * @var int
     */
    public $seatzoneid;

    /**
     * The tickettype ID for the ticket.
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * The tickettypeprice ID for the ticket. This field is required if bundletickets
     * are specified for a fixed bundle. When importing an optionbundle, if one of
     * the bundletickets has a tickettypepriceid, all bundletickets should have one.
     * Setting this, overrides the default behaviour of the configured bundle
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * Unpack ImportBundleTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ImportBundleTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ImportBundleTicket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "overrideprice" => isset($obj->overrideprice) ? $obj->overrideprice : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "seatzoneid" => isset($obj->seatzoneid) ? $obj->seatzoneid : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
        ));
    }

    /**
     * Serialize ImportBundleTicket to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->overrideprice)) {
            $result["overrideprice"] = (bool)$this->overrideprice;
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->seatzoneid)) {
            $result["seatzoneid"] = intval($this->seatzoneid);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }

        return $result;
    }
}
