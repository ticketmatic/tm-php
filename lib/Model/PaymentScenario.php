<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentScenario implements \jsonSerializable
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
     * @var PaymentscenarioOverdueParameters
     */
    public $overdueparameters;

    /**
     * @var PaymentscenarioExpiryParameters
     */
    public $expiryparameters;

    /**
     * @var PaymentscenarioAvailability
     */
    public $availability;

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
     * Convert PaymentScenario to UpdatePaymentScenario
     *
     * @return UpdatePaymentScenario
     */
    public function toUpdate() {
        $result = new UpdatePaymentScenario();
        $result->name = $this->name;
        $result->shortdescription = $this->shortdescription;
        $result->internalremark = $this->internalremark;
        $result->typeid = $this->typeid;
        $result->overdueparameters = $this->overdueparameters;
        $result->expiryparameters = $this->expiryparameters;
        $result->availability = $this->availability;
        $result->paymentmethods = $this->paymentmethods;
        $result->ordermailtemplateid_paymentinstruction = $this->ordermailtemplateid_paymentinstruction;
        $result->ordermailtemplateid_overdue = $this->ordermailtemplateid_overdue;
        $result->ordermailtemplateid_expiry = $this->ordermailtemplateid_expiry;
        return $result;
    }

    /**
     * Unpack PaymentScenario from JSON.
     *
     * @return PaymentScenario
     */
    public static function fromJson($obj) {
        return new PaymentScenario(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "overdueparameters" => PaymentscenarioOverdueParameters::fromJson($obj->overdueparameters),
            "expiryparameters" => PaymentscenarioExpiryParameters::fromJson($obj->expiryparameters),
            "availability" => PaymentscenarioAvailability::fromJson($obj->availability),
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
     * Serialize PaymentScenario to JSON.
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
            if (!is_null($this->overdueparameters)) {
                $result["overdueparameters"] = $this->overdueparameters;
            }
            if (!is_null($this->expiryparameters)) {
                $result["expiryparameters"] = $this->expiryparameters;
            }
            if (!is_null($this->availability)) {
                $result["availability"] = $this->availability;
            }
            if (!is_null($this->paymentmethods)) {
                $result["paymentmethods"] = $this->paymentmethods;
            }
            if (!is_null($this->ordermailtemplateid_paymentinstruction)) {
                $result["ordermailtemplateid_paymentinstruction"] = $this->ordermailtemplateid_paymentinstruction;
            }
            if (!is_null($this->ordermailtemplateid_overdue)) {
                $result["ordermailtemplateid_overdue"] = $this->ordermailtemplateid_overdue;
            }
            if (!is_null($this->ordermailtemplateid_expiry)) {
                $result["ordermailtemplateid_expiry"] = $this->ordermailtemplateid_expiry;
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
