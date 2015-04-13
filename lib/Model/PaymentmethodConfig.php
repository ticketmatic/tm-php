<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentmethodConfig implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PaymentmethodConfig from JSON.
     *
     * @return PaymentmethodConfig
     */
    public static function fromJson($obj) {
        return new PaymentmethodConfig(array(
        ));
    }

    /**
     * Serialize PaymentmethodConfig to JSON.
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
