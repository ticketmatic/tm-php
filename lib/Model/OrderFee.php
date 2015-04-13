<?php
namespace Ticketmatic\Model;

class OrderFee
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
     * @var int
     */
    public $typeid;

    /**
     * @var OrderfeeRule
     */
    public $rule;

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
     * Convert OrderFee to UpdateOrderFee
     *
     * @return UpdateOrderFee
     */
    public function toUpdate() {
        $result = new UpdateOrderFee();
        $result->name = $this->name;
        $result->typeid = $this->typeid;
        $result->rule = $this->rule;
        return $result;
    }

}
