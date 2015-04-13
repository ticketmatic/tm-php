<?php
namespace Ticketmatic\Model;

class PaymentscenarioExpiryParameters
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

}
