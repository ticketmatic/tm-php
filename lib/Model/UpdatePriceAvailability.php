<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdatePriceAvailability implements \jsonSerializable
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
     * Unpack UpdatePriceAvailability from JSON.
     *
     * @return UpdatePriceAvailability
     */
    public static function fromJson($obj) {
        return new UpdatePriceAvailability(array(
            "name" => $obj->name,
            "rules" => PriceAvailabilityRules::fromJson($obj->rules),
        ));
    }

    /**
     * Serialize UpdatePriceAvailability to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->rules)) {
                $result["rules"] = $this->rules;
            }

        }
        return $result;
    }
}
