<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateRevenueSplit implements \jsonSerializable
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
     * @var RevenuesplitRules
     */
    public $rules;

    /**
     * Unpack UpdateRevenueSplit from JSON.
     *
     * @return UpdateRevenueSplit
     */
    public static function fromJson($obj) {
        return new UpdateRevenueSplit(array(
            "name" => $obj->name,
            "rules" => RevenuesplitRules::fromJson($obj->rules),
        ));
    }

    /**
     * Serialize UpdateRevenueSplit to JSON.
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
