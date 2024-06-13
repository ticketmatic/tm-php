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
 * A single ticketsalesflow.
 *
 * More info: see the get operation (api/settings/system/ticketsalesflows/get) and
 * the ticketsalesflows endpoint (api/settings/system/ticketsalesflows).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Ticketsalesflow).
 */
class Ticketsalesflow implements \jsonSerializable
{
    /**
     * Create a new Ticketsalesflow
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
     * **Note:** Ignored when creating a new ticketsalesflow.
     *
     * **Note:** Ignored when updating an existing ticketsalesflow.
     *
     * @var int
     */
    public $id;

    /**
     * Name
     *
     * @var string
     */
    public $name;

    /**
     * Fielddefinition used to define the availability of events for this flow
     *
     * @var string
     */
    public $availabilityfielddefinition;

    /**
     * Unique code used for the flow. Should only contain lower case letters and digits
     *
     * @var string
     */
    public $code;

    /**
     * Config for the flow
     *
     * @var \Ticketmatic\Model\TicketsalesFlowConfig[]
     */
    public $config;

    /**
     * Description
     *
     * @var string
     */
    public $description;

    /**
     * For flows with supported parameter 'product': the set of ProductTypes for which
     * this flow is available
     *
     * @var int[]
     */
    public $productavailability;

    /**
     * Supported parameters for the flow
     *
     * @var string[]
     */
    public $supportedparameters;

    /**
     * Whether or not the flow is in test mode
     *
     * @var bool
     */
    public $testmode;

    /**
     * Ticket sales setup this flow belongs to
     *
     * @var int
     */
    public $ticketsalessetupid;

    /**
     * Unpack Ticketsalesflow from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Ticketsalesflow
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Ticketsalesflow(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "availabilityfielddefinition" => isset($obj->availabilityfielddefinition) ? $obj->availabilityfielddefinition : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "config" => isset($obj->config) ? Json::unpackArray("TicketsalesFlowConfig", $obj->config) : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "productavailability" => isset($obj->productavailability) ? $obj->productavailability : null,
            "supportedparameters" => isset($obj->supportedparameters) ? $obj->supportedparameters : null,
            "testmode" => isset($obj->testmode) ? $obj->testmode : null,
            "ticketsalessetupid" => isset($obj->ticketsalessetupid) ? $obj->ticketsalessetupid : null,
        ));
    }

    /**
     * Serialize Ticketsalesflow to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->availabilityfielddefinition)) {
            $result["availabilityfielddefinition"] = strval($this->availabilityfielddefinition);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->config)) {
            $result["config"] = $this->config;
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->productavailability)) {
            $result["productavailability"] = $this->productavailability;
        }
        if (!is_null($this->supportedparameters)) {
            $result["supportedparameters"] = $this->supportedparameters;
        }
        if (!is_null($this->testmode)) {
            $result["testmode"] = (bool)$this->testmode;
        }
        if (!is_null($this->ticketsalessetupid)) {
            $result["ticketsalessetupid"] = intval($this->ticketsalessetupid);
        }

        return $result;
    }
}
