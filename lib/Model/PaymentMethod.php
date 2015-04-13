<?php
namespace Ticketmatic\Model;

class PaymentMethod
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

}
