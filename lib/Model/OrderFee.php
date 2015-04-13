<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class OrderFee implements \jsonSerializable
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
     * @var OrderfeeRule
     */
    public $rule;

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
     * Convert OrderFee to UpdateOrderFee
     *
     * @return UpdateOrderFee
     */
    public function toUpdate() {
        $result = new UpdateOrderFee();
        $result->name = $this->name;
        $result->typeid = $this->typeid;
        $result->rule = $this->rule;
        return $result;
    }

    /**
     * Unpack OrderFee from JSON.
     *
     * @return OrderFee
     */
    public static function fromJson($obj) {
        return new OrderFee(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "rule" => OrderfeeRule::fromJson($obj->rule),
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize OrderFee to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = $this->id;
            }
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = $this->typeid;
            }
            if (!is_null($this->rule)) {
                $result["rule"] = $this->rule;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = $this->isarchived;
            }

        }
        return $result;
    }
}
