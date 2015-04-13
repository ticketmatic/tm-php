<?php
namespace Ticketmatic\Model;

class CreateLockType
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
     * @var bool
     */
    public $ishardlock;

}
