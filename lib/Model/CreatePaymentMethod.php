<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreatePaymentMethod implements \jsonSerializable
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
     * Unpack CreatePaymentMethod from JSON.
     *
     * @return CreatePaymentMethod
     */
    public static function fromJson($obj) {
        return new CreatePaymentMethod(array(
            "name" => $obj->name,
            "internalremark" => $obj->internalremark,
            "paymentmethodtypeid" => $obj->paymentmethodtypeid,
            "paymentmethodreceiverid" => $obj->paymentmethodreceiverid,
            "config" => PaymentmethodConfig::fromJson($obj->config),
        ));
    }

    /**
     * Serialize CreatePaymentMethod to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
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

        }
        return $result;
    }
}
