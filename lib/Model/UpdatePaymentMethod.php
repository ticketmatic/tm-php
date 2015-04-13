<?php
namespace Ticketmatic\Model;

class UpdatePaymentMethod
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

}
