<?php
namespace Ticketmatic;

class ClientException extends \Exception {
    public function __construct($code, $output) {
        parent::__construct("Unexpected result $code: $output");
    }
}
