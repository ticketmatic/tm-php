<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PaymentMethod implements \jsonSerializable
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
    public $internalremark;

    /**
     * @var int
     */
    public $paymentmethodtypeid;

    /**
     * @var int
     */
    public $paymentmethodreceiverid;

    /**
     * @var PaymentmethodConfig
     */
    public $config;

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
     * Convert PaymentMethod to UpdatePaymentMethod
     *
     * @return UpdatePaymentMethod
     */
    public function toUpdate() {
        $result = new UpdatePaymentMethod();
        $result->name = $this->name;
        $result->internalremark = $this->internalremark;
        $result->paymentmethodtypeid = $this->paymentmethodtypeid;
        $result->paymentmethodreceiverid = $this->paymentmethodreceiverid;
        $result->config = $this->config;
        return $result;
    }

    /**
     * Unpack PaymentMethod from JSON.
     *
     * @return PaymentMethod
     */
    public static function fromJson($obj) {
        return new PaymentMethod(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "internalremark" => $obj->internalremark,
            "paymentmethodtypeid" => $obj->paymentmethodtypeid,
            "paymentmethodreceiverid" => $obj->paymentmethodreceiverid,
            "config" => PaymentmethodConfig::fromJson($obj->config),
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize PaymentMethod to JSON.
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
            if (!is_null($this->internalremark)) {
                $result["internalremark"] = strval($this->internalremark);
            }
            if (!is_null($this->paymentmethodtypeid)) {
                $result["paymentmethodtypeid"] = intval($this->paymentmethodtypeid);
            }
            if (!is_null($this->paymentmethodreceiverid)) {
                $result["paymentmethodreceiverid"] = intval($this->paymentmethodreceiverid);
            }
            if (!is_null($this->config)) {
                $result["config"] = $this->config;
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
