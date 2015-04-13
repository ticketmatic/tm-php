<?php
namespace Ticketmatic\Model;

class PriceType
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
     * @var string
     */
    public $remark;

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
     * Convert PriceType to UpdatePriceType
     *
     * @return UpdatePriceType
     */
    public function toUpdate() {
        $result = new UpdatePriceType();
        $result->name = $this->name;
        $result->typeid = $this->typeid;
        $result->remark = $this->remark;
        return $result;
    }

}
