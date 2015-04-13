<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentscenarioExpiryParameters implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PaymentscenarioExpiryParameters from JSON.
     *
     * @return PaymentscenarioExpiryParameters
     */
    public static function fromJson($obj) {
        return new PaymentscenarioExpiryParameters(array(
        ));
    }

    /**
     * Serialize PaymentscenarioExpiryParameters to JSON.
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
