<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PriceAvailability implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var PriceAvailabilityRules
     */
    public $rules;

    /**
     * Created timestamp
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Whether or not this item is archived
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Convert PriceAvailability to UpdatePriceAvailability
     *
     * @return UpdatePriceAvailability
     */
    public function toUpdate() {
        $result = new UpdatePriceAvailability();
        $result->name = $this->name;
        $result->rules = $this->rules;
        return $result;
    }

    /**
     * Unpack PriceAvailability from JSON.
     *
     * @return PriceAvailability
     */
    public static function fromJson($obj) {
        return new PriceAvailability(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "rules" => PriceAvailabilityRules::fromJson($obj->rules),
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize PriceAvailability to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->rules)) {
                $result["rules"] = $this->rules;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = boolval($this->isarchived);
            }

        }
        return $result;
    }
}
