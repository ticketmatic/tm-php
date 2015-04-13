<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class Event implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack Event from JSON.
     *
     * @return Event
     */
    public static function fromJson($obj) {
        return new Event(array(
        ));
    }

    /**
     * Serialize Event to JSON.
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
