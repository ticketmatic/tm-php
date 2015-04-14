<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class DeliveryScenario implements \jsonSerializable
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
     * @var DeliveryscenarioAvailability
     */
    public $availability;

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
     * Convert DeliveryScenario to UpdateDeliveryScenario
     *
     * @return UpdateDeliveryScenario
     */
    public function toUpdate() {
        $result = new UpdateDeliveryScenario();
        $result->name = $this->name;
        $result->shortdescription = $this->shortdescription;
        $result->internalremark = $this->internalremark;
        $result->typeid = $this->typeid;
        $result->needsaddress = $this->needsaddress;
        $result->availability = $this->availability;
        $result->ordermailtemplateid_delivery = $this->ordermailtemplateid_delivery;
        $result->allowetickets = $this->allowetickets;
        return $result;
    }

    /**
     * Unpack DeliveryScenario from JSON.
     *
     * @return DeliveryScenario
     */
    public static function fromJson($obj) {
        return new DeliveryScenario(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "needsaddress" => $obj->needsaddress,
            "availability" => DeliveryscenarioAvailability::fromJson($obj->availability),
            "ordermailtemplateid_delivery" => $obj->ordermailtemplateid_delivery,
            "allowetickets" => $obj->allowetickets,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize DeliveryScenario to JSON.
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
            if (!is_null($this->shortdescription)) {
                $result["shortdescription"] = strval($this->shortdescription);
            }
            if (!is_null($this->internalremark)) {
                $result["internalremark"] = strval($this->internalremark);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->needsaddress)) {
                $result["needsaddress"] = boolval($this->needsaddress);
            }
            if (!is_null($this->availability)) {
                $result["availability"] = $this->availability;
            }
            if (!is_null($this->ordermailtemplateid_delivery)) {
                $result["ordermailtemplateid_delivery"] = intval($this->ordermailtemplateid_delivery);
            }
            if (!is_null($this->allowetickets)) {
                $result["allowetickets"] = intval($this->allowetickets);
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
