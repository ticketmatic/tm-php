<?php
namespace Ticketmatic\Model;

class TicketfeeRules
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

}
