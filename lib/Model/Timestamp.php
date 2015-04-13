<?php
namespace Ticketmatic\Model;

/**
 * A timestamp returned by the diagnostic /time call
 * (https://apps.ticketmatic.com/#/knowledgebase/api/diagnostics/time).
 */
class Timestamp
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Current system time
     *
     * @var \DateTime
     */
    public $systemtime;

}
