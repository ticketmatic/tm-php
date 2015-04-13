<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class OrderfeeRule implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack OrderfeeRule from JSON.
     *
     * @return OrderfeeRule
     */
    public static function fromJson($obj) {
        return new OrderfeeRule(array(
        ));
    }

    /**
     * Serialize OrderfeeRule to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {

        }
        return $result;
    }
}
