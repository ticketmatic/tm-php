<?php
namespace Ticketmatic\Model;

class PaymentScenario
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

}
