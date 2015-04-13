<?php
namespace Ticketmatic\Model;

class TicketFee
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
     * @var TicketfeeRules
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
     * Convert TicketFee to UpdateTicketFee
     *
     * @return UpdateTicketFee
     */
    public function toUpdate() {
        $result = new UpdateTicketFee();
        $result->name = $this->name;
        $result->rules = $this->rules;
        return $result;
    }

}
