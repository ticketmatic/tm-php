<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentscenarioAvailability implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PaymentscenarioAvailability from JSON.
     *
     * @return PaymentscenarioAvailability
     */
    public static function fromJson($obj) {
        return new PaymentscenarioAvailability(array(
        ));
    }

    /**
     * Serialize PaymentscenarioAvailability to JSON.
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
