<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreateLockType implements \jsonSerializable
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
     * @var bool
     */
    public $ishardlock;

    /**
     * Unpack CreateLockType from JSON.
     *
     * @return CreateLockType
     */
    public static function fromJson($obj) {
        return new CreateLockType(array(
            "name" => $obj->name,
            "ishardlock" => $obj->ishardlock,
        ));
    }

    /**
     * Serialize CreateLockType to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->ishardlock)) {
                $result["ishardlock"] = $this->ishardlock;
            }

        }
        return $result;
    }
}
