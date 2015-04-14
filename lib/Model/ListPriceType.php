<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListPriceType implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * @var int
     */
    public $id;

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
     * Created timestamp
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Whether or not this item is archived
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Unpack ListPriceType from JSON.
     *
     * @return ListPriceType
     */
    public static function fromJson($obj) {
        return new ListPriceType(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "remark" => $obj->remark,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListPriceType to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->remark)) {
                $result["remark"] = strval($this->remark);
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = boolval($this->isarchived);
            }

        }
        return $result;
    }
}
