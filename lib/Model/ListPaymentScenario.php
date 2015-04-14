<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListPaymentScenario implements \jsonSerializable
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
     * Name of the payment scenario
     *
     * @var string
     */
    public $name;

    /**
     * Short description of the payment scenario, will be shown to customers
     *
     * @var string
     */
    public $shortdescription;

    /**
     * An internal remark, which is never shown to customers. Can be used to distinguish identically
     * named payment scenarios.
     *
     * For example: You could have two VISA scenarios, one for the web sales and one for the box
     * office, each will have different fee configurations. Both will be named VISA, this field can be
     * used to distinguish them.
     *
     * @var string
     */
    public $internalremark;

    /**
     * @var int
     */
    public $typeid;

    /**
     * @var int[]
     */
    public $paymentmethods;

    /**
     * @var int
     */
    public $ordermailtemplateid_paymentinstruction;

    /**
     * @var int
     */
    public $ordermailtemplateid_overdue;

    /**
     * @var int
     */
    public $ordermailtemplateid_expiry;

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
     * Unpack ListPaymentScenario from JSON.
     *
     * @return ListPaymentScenario
     */
    public static function fromJson($obj) {
        return new ListPaymentScenario(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "paymentmethods" => Json::unpackArray("int", $obj->paymentmethods),
            "ordermailtemplateid_paymentinstruction" => $obj->ordermailtemplateid_paymentinstruction,
            "ordermailtemplateid_overdue" => $obj->ordermailtemplateid_overdue,
            "ordermailtemplateid_expiry" => $obj->ordermailtemplateid_expiry,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListPaymentScenario to JSON.
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
            if (!is_null($this->paymentmethods)) {
                $result["paymentmethods"] = $this->paymentmethods;
            }
            if (!is_null($this->ordermailtemplateid_paymentinstruction)) {
                $result["ordermailtemplateid_paymentinstruction"] = intval($this->ordermailtemplateid_paymentinstruction);
            }
            if (!is_null($this->ordermailtemplateid_overdue)) {
                $result["ordermailtemplateid_overdue"] = intval($this->ordermailtemplateid_overdue);
            }
            if (!is_null($this->ordermailtemplateid_expiry)) {
                $result["ordermailtemplateid_expiry"] = intval($this->ordermailtemplateid_expiry);
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
