<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreateOrderFee implements \jsonSerializable
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
     * @var int
     */
    public $typeid;

    /**
     * @var OrderfeeRule
     */
    public $rule;

    /**
     * Unpack CreateOrderFee from JSON.
     *
     * @return CreateOrderFee
     */
    public static function fromJson($obj) {
        return new CreateOrderFee(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "rule" => OrderfeeRule::fromJson($obj->rule),
        ));
    }

    /**
     * Serialize CreateOrderFee to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->rule)) {
                $result["rule"] = $this->rule;
            }

        }
        return $result;
    }
}
