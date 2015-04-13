<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class Ticket implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack Ticket from JSON.
     *
     * @return Ticket
     */
    public static function fromJson($obj) {
        return new Ticket(array(
        ));
    }

    /**
     * Serialize Ticket to JSON.
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
