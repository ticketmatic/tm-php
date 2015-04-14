<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class EventParameters implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If this parameter is true, archived items will be returned as well.
     *
     * @var bool
     */
    public $includearchived;

    /**
     * Unpack EventParameters from JSON.
     *
     * @return EventParameters
     */
    public static function fromJson($obj) {
        return new EventParameters(array(
            "includearchived" => $obj->includearchived,
        ));
    }

    /**
     * Serialize EventParameters to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->includearchived)) {
                $result["includearchived"] = boolval($this->includearchived);
            }

        }
        return $result;
    }
}
