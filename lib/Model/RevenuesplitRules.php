<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class RevenuesplitRules implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack RevenuesplitRules from JSON.
     *
     * @return RevenuesplitRules
     */
    public static function fromJson($obj) {
        return new RevenuesplitRules(array(
        ));
    }

    /**
     * Serialize RevenuesplitRules to JSON.
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
