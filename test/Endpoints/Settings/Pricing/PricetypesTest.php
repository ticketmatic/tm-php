<?php
namespace Ticketmatic\Test\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Settings\Pricing\Pricetypes;

class PricetypesTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(0, count($req));

        $req2params = new PriceTypeParameters();
        $req2params->filter = "select id from conf.pricetype where typeid=2301";
        $req2 = Pricetypes::getlist($client, $req2params);

        $this->assertGreaterThan(count($req2), count($req));

    }

    public function testCreatedelete() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(0, count($req));

        $req2data = new CreatePriceType();
        $req2data->name = "test";
        $req2 = Pricetypes::create($client, $req2data);

        $this->assertEquals("test", $req2->name);
        // TODO: isrecent

        $req3 = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(count($req), count($req3));

        $req4 = Pricetypes::get($client, $req2->id);

        $this->assertEquals("test", $req4->name);

        Pricetypes::delete($client, $req2->id);

        $req6 = Pricetypes::getlist($client, null);

        $this->assertEquals(count($req6), count($req));

    }

}
