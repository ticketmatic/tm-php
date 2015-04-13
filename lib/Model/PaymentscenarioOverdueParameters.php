<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentscenarioOverdueParameters implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PaymentscenarioOverdueParameters from JSON.
     *
     * @return PaymentscenarioOverdueParameters
     */
    public static function fromJson($obj) {
        return new PaymentscenarioOverdueParameters(array(
        ));
    }

    /**
     * Serialize PaymentscenarioOverdueParameters to JSON.
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
