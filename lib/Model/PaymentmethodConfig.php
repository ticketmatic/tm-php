<?php
namespace Ticketmatic\Model;

class PaymentmethodConfig
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

}
