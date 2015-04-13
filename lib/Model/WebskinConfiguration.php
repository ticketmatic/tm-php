<?php
namespace Ticketmatic\Model;

class WebskinConfiguration
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

}
