<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * Information about the availability of tickets for a contingent
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventContingentAvailability).
 */
class EventContingentAvailability implements \jsonSerializable
{
    /**
     * Create a new EventContingentAvailability
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Contingent ID
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Total number of tickets in the contingent
     *
     * @var int
     */
    public $total;

    /**
     * Number of locked tickets with a hard lock type
     *
     * @var int
     */
    public $locked_hard;

    /**
     * Number of locked tickets with a soft lock type
     *
     * @var int
     */
    public $locked_soft;

    /**
     * Number of tickets reserved in unconfirmed orders
     *
     * @var int
     */
    public $reserved;

    /**
     * Number of tickets in confirmed orders that are completely paid
     *
     * @var int
     */
    public $sold_paid;

    /**
     * Number of tickets in confirmed orders that are not completely paid
     *
     * @var int
     */
    public $sold_unpaid;

    /**
     * Number of complimentary tickets
     *
     * @var int
     */
    public $complimentary;

    /**
     * Number of available tickets
     *
     * @var int
     */
    public $free;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack EventContingentAvailability from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventContingentAvailability
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventContingentAvailability(array(
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "total" => isset($obj->total) ? $obj->total : null,
            "locked_hard" => isset($obj->locked_hard) ? $obj->locked_hard : null,
            "locked_soft" => isset($obj->locked_soft) ? $obj->locked_soft : null,
            "reserved" => isset($obj->reserved) ? $obj->reserved : null,
            "sold_paid" => isset($obj->sold_paid) ? $obj->sold_paid : null,
            "sold_unpaid" => isset($obj->sold_unpaid) ? $obj->sold_unpaid : null,
            "complimentary" => isset($obj->complimentary) ? $obj->complimentary : null,
            "free" => isset($obj->free) ? $obj->free : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize EventContingentAvailability to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->total)) {
            $result["total"] = intval($this->total);
        }
        if (!is_null($this->locked_hard)) {
            $result["locked_hard"] = intval($this->locked_hard);
        }
        if (!is_null($this->locked_soft)) {
            $result["locked_soft"] = intval($this->locked_soft);
        }
        if (!is_null($this->reserved)) {
            $result["reserved"] = intval($this->reserved);
        }
        if (!is_null($this->sold_paid)) {
            $result["sold_paid"] = intval($this->sold_paid);
        }
        if (!is_null($this->sold_unpaid)) {
            $result["sold_unpaid"] = intval($this->sold_unpaid);
        }
        if (!is_null($this->complimentary)) {
            $result["complimentary"] = intval($this->complimentary);
        }
        if (!is_null($this->free)) {
            $result["free"] = intval($this->free);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}