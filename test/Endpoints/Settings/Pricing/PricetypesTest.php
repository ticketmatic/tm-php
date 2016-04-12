<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Test\Endpoints\Settings\Pricing;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Settings\Pricing\Pricetypes;
use Ticketmatic\Model\PriceType;
use Ticketmatic\Model\PriceTypeQuery;

class PricetypesTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(0, count($req->data));

        $req2params = new PriceTypeQuery(array(
            "filter" => "select id from conf.pricetype where typeid=2301",
        ));
        $req2 = Pricetypes::getlist($client, $req2params);

        $this->assertGreaterThan(count($req2->data), count($req->data));

    }

    public function testCreatedelete() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(0, count($req->data));

        $req2 = Pricetypes::create($client, array(
            "name" => "test",
        ));

        $this->assertEquals("test", $req2->name);
        $this->assertGreaterThan(time() - 3600, $req2->createdts->getTimestamp());

        $req3 = Pricetypes::getlist($client, null);

        $this->assertGreaterThan(count($req->data), count($req3->data));

        $req4 = Pricetypes::get($client, $req2->id);

        $this->assertEquals("test", $req4->name);

        Pricetypes::delete($client, $req2->id);

        $req6 = Pricetypes::getlist($client, null);

        $this->assertEquals(count($req6->data), count($req->data));

    }

    public function testTranslations() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Pricetypes::get($client, 4);

        $this->assertEquals("Free ticket", $req->name);

        $client->setLanguage("nl");
        $req2 = Pricetypes::get($client, 4);

        $this->assertEquals("Gratis ticket", $req2->name);

        $updated = Pricetypes::update($client, 4, array(
            "name" => "Vrijkaart",
        ));

        $this->assertEquals("Vrijkaart", $updated->name);

        $client->setLanguage("en");
        $req3 = Pricetypes::get($client, 4);

        $this->assertEquals("Free ticket", $req3->name);

        $client->setLanguage("nl");
        $updated2 = Pricetypes::update($client, 4, array(
            "name" => "Gratis ticket",
        ));

        $this->assertEquals("Gratis ticket", $updated2->name);

        $translations = Pricetypes::translations($client, 4);

        $this->assertEquals($translations->nameen, "Free ticket");
        $this->assertEquals($translations->namenl, "Gratis ticket");

    }

}
