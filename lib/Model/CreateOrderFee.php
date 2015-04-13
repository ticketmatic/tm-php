<?php
namespace Ticketmatic\Model;

class CreateOrderFee
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
     * @var int
     */
    public $typeid;

    /**
     * @var OrderfeeRule
     */
    public $rule;

}
