<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Test\Endpoints\Settings\Seatingplans;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Settings\Seatingplans\Seatingplans;
use Ticketmatic\Model\LockTemplate;
use Ticketmatic\Model\LogicalPlan;
use Ticketmatic\Model\SeatDescriptionTemplate;
use Ticketmatic\Model\SeatingPlan;
use Ticketmatic\Model\SeatingPlanQuery;

class SeatingplansTest extends \PHPUnit_Framework_TestCase {

    public function testCreatesinglezone() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $seatingplan = Seatingplans::create($client, array(
            "name" => "The Ballroom",
            "status" => "draft",
            "useszones" => false,
        ));

        $this->assertEquals("The Ballroom", $seatingplan->name);
        $this->assertEquals("draft", $seatingplan->status);
        $this->assertEquals(false, $seatingplan->useszones);

    }

    public function testCreatemultizone() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $seatingplan = Seatingplans::create($client, array(
            "name" => "The Opera House",
            "status" => "draft",
            "useszones" => true,
        ));

        $this->assertEquals("The Opera House", $seatingplan->name);
        $this->assertEquals("draft", $seatingplan->status);
        $this->assertEquals(true, $seatingplan->useszones);

    }

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $list = Seatingplans::getlist($client, null);

        $this->assertGreaterThan(0, count($list->data));

        $seatingplan = Seatingplans::get($client, $list->data[0]->id);

        $this->assertEquals($list->data[0]->id, $seatingplan->id);

    }

}
