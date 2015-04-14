<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateLockType implements \jsonSerializable
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
     * Unpack UpdateLockType from JSON.
     *
     * @return UpdateLockType
     */
    public static function fromJson($obj) {
        return new UpdateLockType(array(
            "name" => $obj->name,
            "ishardlock" => $obj->ishardlock,
        ));
    }

    /**
     * Serialize UpdateLockType to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->ishardlock)) {
                $result["ishardlock"] = boolval($this->ishardlock);
            }

        }
        return $result;
    }
}
