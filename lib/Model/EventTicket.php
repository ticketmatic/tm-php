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
 * A single ticket.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventTicket).
 */
class EventTicket implements \jsonSerializable
{
    /**
     * Create a new EventTicket
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Ticket ID
     *
     * @var int
     */
    public $id;

    /**
     * Ticket barcode
     *
     * @var string
     */
    public $barcode;

    /**
     * Seat ID (for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatid;

    /**
     * Link to the contingent this ticket belongs to
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

    /**
     * Unpack EventTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new EventTicket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "barcode" => isset($obj->barcode) ? $obj->barcode : null,
            "seatid" => isset($obj->seatid) ? $obj->seatid : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
        ));

        $result->custom_fields = array();
        foreach ($obj as $key => $value) {
            if (substr($key, 0, 2) === "c_") {
                $key = substr($key, 2);
                $result->custom_fields[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Serialize EventTicket to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->barcode)) {
            $result["barcode"] = strval($this->barcode);
        }
        if (!is_null($this->seatid)) {
            $result["seatid"] = strval($this->seatid);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }


        if (is_array($this->custom_fields)) {
            foreach ($this->custom_fields as $key => $value) {
                $result["c_" . $key] = $value;
            }
        }

        return $result;
    }
}
