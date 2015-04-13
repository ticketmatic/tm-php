<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdatePriceType implements \jsonSerializable
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
     * @var int
     */
    public $typeid;

    /**
     * @var string
     */
    public $remark;

    /**
     * Unpack UpdatePriceType from JSON.
     *
     * @return UpdatePriceType
     */
    public static function fromJson($obj) {
        return new UpdatePriceType(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "remark" => $obj->remark,
        ));
    }

    /**
     * Serialize UpdatePriceType to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = $this->typeid;
            }
            if (!is_null($this->remark)) {
                $result["remark"] = $this->remark;
            }

        }
        return $result;
    }
}
