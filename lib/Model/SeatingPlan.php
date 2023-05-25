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
 * A single seating plan.
 *
 * More info: see the get operation (api/settings/seatingplans/seatingplans/get)
 * and the seating plans endpoint (api/settings/seatingplans/seatingplans).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SeatingPlan).
 */
class SeatingPlan implements \jsonSerializable
{
    /**
     * Create a new SeatingPlan
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
     * **Note:** Ignored when creating a new seating plan.
     *
     * **Note:** Ignored when updating an existing seating plan.
     *
     * @var int
     */
    public $id;

    /**
     * The name for the seating plan
     *
     * @var string
     */
    public $name;

    /**
     * The status this seating plan is in
     *
     * @var string
     */
    public $status;

    /**
     * Translations for the seat description templates
     *
     * **Note:** Not set when retrieving a list of seating plans.
     *
     * @var string[]
     */
    public $translations;

    /**
     * When true: treat as a multi-zoned seatingplan
     *
     * @var bool
     */
    public $useszones;

    /**
     * IDs of the seat zones defined
     *
     * **Note:** Ignored when creating a new seating plan.
     *
     * **Note:** Ignored when updating an existing seating plan.
     *
     * **Note:** Not set when retrieving a list of seating plans.
     *
     * @var int[]
     */
    public $zones;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new seating plan.
     *
     * **Note:** Ignored when updating an existing seating plan.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new seating plan.
     *
     * **Note:** Ignored when updating an existing seating plan.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new seating plan.
     *
     * **Note:** Ignored when updating an existing seating plan.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack SeatingPlan from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SeatingPlan
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SeatingPlan(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "useszones" => isset($obj->useszones) ? $obj->useszones : null,
            "zones" => isset($obj->zones) ? $obj->zones : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize SeatingPlan to JSON.
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
        if (!is_null($this->status)) {
            $result["status"] = strval($this->status);
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
        }
        if (!is_null($this->useszones)) {
            $result["useszones"] = (bool)$this->useszones;
        }
        if (!is_null($this->zones)) {
            $result["zones"] = $this->zones;
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
