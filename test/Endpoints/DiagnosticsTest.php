<?php
namespace Ticketmatic\Test\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Diagnostics;
use Ticketmatic\Model\Timestamp;

class DiagnosticsTest extends \PHPUnit_Framework_TestCase {

    public function testGetTime() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Diagnostics::time($client);

        $this->assertGreaterThan(time() - 3600, $req->systemtime->getTimestamp());

    }

}
