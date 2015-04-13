<?php
namespace Ticketmatic\Model;

class PaymentscenarioAvailability
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

}
