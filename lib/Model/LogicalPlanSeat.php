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
 * The definition of a seat.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/LogicalPlanSeat).
 */
class LogicalPlanSeat implements \jsonSerializable
{
    /**
     * Create a new LogicalPlanSeat
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The ID of the seat
     *
     * @var string
     */
    public $id;

    /**
     * The name of the seat
     *
     * @var string
     */
    public $name;

    /**
     * The center point [x,y] of the seat
     *
     * @var float[]
     */
    public $center;

    /**
     * The coordinate of the seat
     *
     * @var int
     */
    public $coord;

    /**
     * Should this seat be sold prior to other seats
     *
     * @var int
     */
    public $priority;

    /**
     * The rowname of the seat
     *
     * @var string
     */
    public $rowname;

    /**
     * The seat description template for this seat
     *
     * @var int
     */
    public $seatdescriptionid;

    /**
     * The seat rank for this seat
     *
     * @var int
     */
    public $seatrankid;

    /**
     * The width and height of the seat
     *
     * @var float[]
     */
    public $size;

    /**
     * Unpack LogicalPlanSeat from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\LogicalPlanSeat
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new LogicalPlanSeat(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "center" => isset($obj->center) ? $obj->center : null,
            "coord" => isset($obj->coord) ? $obj->coord : null,
            "priority" => isset($obj->priority) ? $obj->priority : null,
            "rowname" => isset($obj->rowname) ? $obj->rowname : null,
            "seatdescriptionid" => isset($obj->seatdescriptionid) ? $obj->seatdescriptionid : null,
            "seatrankid" => isset($obj->seatrankid) ? $obj->seatrankid : null,
            "size" => isset($obj->size) ? $obj->size : null,
        ));
    }

    /**
     * Serialize LogicalPlanSeat to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = strval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->center)) {
            $result["center"] = $this->center;
        }
        if (!is_null($this->coord)) {
            $result["coord"] = intval($this->coord);
        }
        if (!is_null($this->priority)) {
            $result["priority"] = intval($this->priority);
        }
        if (!is_null($this->rowname)) {
            $result["rowname"] = strval($this->rowname);
        }
        if (!is_null($this->seatdescriptionid)) {
            $result["seatdescriptionid"] = intval($this->seatdescriptionid);
        }
        if (!is_null($this->seatrankid)) {
            $result["seatrankid"] = intval($this->seatrankid);
        }
        if (!is_null($this->size)) {
            $result["size"] = $this->size;
        }

        return $result;
    }
}
