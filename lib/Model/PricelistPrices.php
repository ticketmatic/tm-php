<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PricelistPrices implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack PricelistPrices from JSON.
     *
     * @return PricelistPrices
     */
    public static function fromJson($obj) {
        return new PricelistPrices(array(
        ));
    }

    /**
     * Serialize PricelistPrices to JSON.
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
