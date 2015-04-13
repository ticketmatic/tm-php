<?php
namespace Ticketmatic\Model;

class EventParameters
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If this parameter is true, archived items will be returned as well.
     *
     * @var bool
     */
    public $includearchived;

}
