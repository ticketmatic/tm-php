<?php
namespace Ticketmatic\Model;

class UpdatePriceAvailability
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
     * @var PriceAvailabilityRules
     */
    public $rules;

}
