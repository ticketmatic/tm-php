<?php
namespace Ticketmatic\Model;

class RevenueSplit
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
     * @var RevenuesplitRules
     */
    public $rules;

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
     * Convert RevenueSplit to UpdateRevenueSplit
     *
     * @return UpdateRevenueSplit
     */
    public function toUpdate() {
        $result = new UpdateRevenueSplit();
        $result->name = $this->name;
        $result->rules = $this->rules;
        return $result;
    }

}
