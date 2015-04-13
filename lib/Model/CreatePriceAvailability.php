<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreatePriceAvailability implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var PriceAvailabilityRules
     */
    public $rules;

    /**
     * Unpack CreatePriceAvailability from JSON.
     *
     * @return CreatePriceAvailability
     */
    public static function fromJson($obj) {
        return new CreatePriceAvailability(array(
            "name" => $obj->name,
            "rules" => PriceAvailabilityRules::fromJson($obj->rules),
        ));
    }

    /**
     * Serialize CreatePriceAvailability to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->rules)) {
                $result["rules"] = $this->rules;
            }

        }
        return $result;
    }
}
