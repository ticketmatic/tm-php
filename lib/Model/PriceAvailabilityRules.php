<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PriceAvailabilityRules implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PriceAvailabilityRules from JSON.
     *
     * @return PriceAvailabilityRules
     */
    public static function fromJson($obj) {
        return new PriceAvailabilityRules(array(
        ));
    }

    /**
     * Serialize PriceAvailabilityRules to JSON.
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
