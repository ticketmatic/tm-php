<?php
namespace Ticketmatic\Test\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Diagnostics;

class DiagnosticsTest extends \PHPUnit_Framework_TestCase {

    public function testGetTime() {
        $accountcode = $_ENV["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_ENV["TM_TEST_ACCESSKEY"];
        $secretkey = $_ENV["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Diagnostics::time($client);

        // TODO: isrecent

    }

}
