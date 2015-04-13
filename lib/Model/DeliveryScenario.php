<?php
namespace Ticketmatic\Model;

class DeliveryScenario
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

}
