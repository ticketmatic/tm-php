<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateRevenueSplitCategory implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $name;

    /**
     * Unpack UpdateRevenueSplitCategory from JSON.
     *
     * @return UpdateRevenueSplitCategory
     */
    public static function fromJson($obj) {
        return new UpdateRevenueSplitCategory(array(
            "name" => $obj->name,
        ));
    }

    /**
     * Serialize UpdateRevenueSplitCategory to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }

        }
        return $result;
    }
}
