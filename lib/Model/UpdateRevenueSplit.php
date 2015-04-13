<?php
namespace Ticketmatic\Model;

class UpdateRevenueSplit
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
     * @var RevenuesplitRules
     */
    public $rules;

}
