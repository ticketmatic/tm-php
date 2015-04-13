<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListDeliveryScenario implements \jsonSerializable
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
     * @var string
     */
    public $shortdescription;

    /**
     * @var string
     */
    public $internalremark;

    /**
     * @var int
     */
    public $typeid;

    /**
     * @var bool
     */
    public $needsaddress;

    /**
     * @var int
     */
    public $ordermailtemplateid_delivery;

    /**
     * @var int
     */
    public $allowetickets;

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
     * Unpack ListDeliveryScenario from JSON.
     *
     * @return ListDeliveryScenario
     */
    public static function fromJson($obj) {
        return new ListDeliveryScenario(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "needsaddress" => $obj->needsaddress,
            "ordermailtemplateid_delivery" => $obj->ordermailtemplateid_delivery,
            "allowetickets" => $obj->allowetickets,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListDeliveryScenario to JSON.
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
            if (!is_null($this->shortdescription)) {
                $result["shortdescription"] = $this->shortdescription;
            }
            if (!is_null($this->internalremark)) {
                $result["internalremark"] = $this->internalremark;
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = $this->typeid;
            }
            if (!is_null($this->needsaddress)) {
                $result["needsaddress"] = $this->needsaddress;
            }
            if (!is_null($this->ordermailtemplateid_delivery)) {
                $result["ordermailtemplateid_delivery"] = $this->ordermailtemplateid_delivery;
            }
            if (!is_null($this->allowetickets)) {
                $result["allowetickets"] = $this->allowetickets;
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
