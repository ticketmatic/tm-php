<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateTicketFee implements \jsonSerializable
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
     * Unpack UpdateTicketFee from JSON.
     *
     * @return UpdateTicketFee
     */
    public static function fromJson($obj) {
        return new UpdateTicketFee(array(
            "name" => $obj->name,
            "rules" => TicketfeeRules::fromJson($obj->rules),
        ));
    }

    /**
     * Serialize UpdateTicketFee to JSON.
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
