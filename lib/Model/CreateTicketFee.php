<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreateTicketFee implements \jsonSerializable
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
     * @var TicketfeeRules
     */
    public $rules;

    /**
     * Unpack CreateTicketFee from JSON.
     *
     * @return CreateTicketFee
     */
    public static function fromJson($obj) {
        return new CreateTicketFee(array(
            "name" => $obj->name,
            "rules" => TicketfeeRules::fromJson($obj->rules),
        ));
    }

    /**
     * Serialize CreateTicketFee to JSON.
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
