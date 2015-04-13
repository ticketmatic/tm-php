<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class Order implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack Order from JSON.
     *
     * @return Order
     */
    public static function fromJson($obj) {
        return new Order(array(
        ));
    }

    /**
     * Serialize Order to JSON.
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
