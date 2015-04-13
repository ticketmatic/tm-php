<?php
namespace Ticketmatic\Model;

class CreatePaymentScenario
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

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

}
