<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class TicketfeeRules implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack TicketfeeRules from JSON.
     *
     * @return TicketfeeRules
     */
    public static function fromJson($obj) {
        return new TicketfeeRules(array(
        ));
    }

    /**
     * Serialize TicketfeeRules to JSON.
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
