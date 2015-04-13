<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class WebskinConfiguration implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unpack WebskinConfiguration from JSON.
     *
     * @return WebskinConfiguration
     */
    public static function fromJson($obj) {
        return new WebskinConfiguration(array(
        ));
    }

    /**
     * Serialize WebskinConfiguration to JSON.
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
