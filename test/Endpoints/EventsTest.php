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

namespace Ticketmatic\Test\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Events;
use Ticketmatic\ClientException;
use Ticketmatic\Model\BatchEventOperation;
use Ticketmatic\Model\Event;
use Ticketmatic\Model\EventLockTickets;
use Ticketmatic\Model\EventQuery;
use Ticketmatic\Model\EventScanTicketsOut;
use Ticketmatic\Model\EventTicket;
use Ticketmatic\Model\EventTicketQuery;
use Ticketmatic\Model\EventUnlockTickets;
use Ticketmatic\Model\EventUpdateSeatRankForTickets;

class EventsTest extends \PHPUnit_Framework_TestCase {

    public function testBatch() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $event = Events::create($client, array(
            "contingents" => array(
                array(
                    "amount" => 100,
                ),
            ),
            "locationid" => 1,
            "name" => "Example",
        ));

        $this->assertEquals("Example", $event->name);
        $this->assertEquals(100, $event->contingents[0]->amount);
        $this->assertEquals(1, $event->locationid);

        $event2 = Events::create($client, array(
            "contingents" => array(
                array(
                    "amount" => 100,
                ),
            ),
            "locationid" => 1,
            "name" => "Example2",
        ));

        $this->assertEquals("Example2", $event2->name);
        $this->assertEquals(100, $event2->contingents[0]->amount);
        $this->assertEquals(1, $event2->locationid);

        Events::batch($client, array(
            "ids" => array(
                $event->id,
                $event2->id,
            ),
            "operation" => "update",
            "parameters" => array(
                "updatefields" => array(
                    array(
                        "key" => "locationid",
                        "value" => 2,
                    ),
                ),
            ),
        ));

    }

    public function testCreate() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $event = Events::create($client, array(
            "contingents" => array(
                array(
                    "amount" => 100,
                ),
            ),
            "name" => "Example",
        ));

        $this->assertEquals("Example", $event->name);
        $this->assertEquals(100, $event->contingents[0]->amount);

    }

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $listparams = new EventQuery(array(
            "output" => "withlookup",
        ));
        $list = Events::getlist($client, $listparams);

        $this->assertGreaterThan(0, count($list->data));

        $event = Events::get($client, $list->data[0]->id);

        $this->assertEquals($list->data[0]->id, $event->id);

    }

    public function testGetconditions() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $req = Events::get($client, 777717);

        $this->assertEquals(777717, $req->id);
        $this->assertEquals("orderticketlimit", $req->prices->contingents[0]->pricetypes[0]->saleschannels[0]->conditions[0]->type);

    }

    public function testGetdraft() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $event = Events::create($client, array(
            "name" => "Draft",
        ));

        $this->assertEquals("Draft", $event->name);

        $listparams = new EventQuery(array(
            "filter" => "select id from tm.event where nameen='Draft'",
            "simplefilter" => array(
                "status" => array(
                    19001,
                    19002,
                    19003,
                ),
            ),
        ));
        $list = Events::getlist($client, $listparams);

        $this->assertGreaterThan(0, count($list->data));

        Events::delete($client, $event->id);

    }

    public function testGettickets() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $list = Events::getlist($client, null);

        $this->assertGreaterThan(0, count($list->data));

        $stream = Events::gettickets($client, $list->data[0]->id, null);

        $tickets = array();
        while($ticketsitem = $stream->next()) {
            $tickets[] = $ticketsitem;
        }

    }

    public function testDeletefixedbundleevent() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        try {
            Events::delete($client, 777704);
            throw new \Exception("Expected a ClientException");
        } catch (ClientException $ex) {
            $this->assertEquals($ex->getCode(), 400);
        }

    }

    public function testLockunlocktickets() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $listparams = new EventQuery(array(
            "filter" => "select id from tm.event where seatingplanid is not null and id < 777800",
            "limit" => 1,
            "orderby" => "name",
            "output" => "ids",
        ));
        $list = Events::getlist($client, $listparams);

        $this->assertGreaterThan(0, count($list->data));

        $stream = Events::gettickets($client, $list->data[0]->id, null);

        $tickets = array();
        while($ticketsitem = $stream->next()) {
            $tickets[] = $ticketsitem;
        }

        $this->assertGreaterThan(0, count($tickets));

        Events::locktickets($client, $list->data[0]->id, array(
            "locktypeid" => 1,
            "ticketids" => array(
                $tickets[0]->id,
                $tickets[1]->id,
            ),
        ));

        Events::unlocktickets($client, $list->data[0]->id, array(
            "ticketids" => array(
                $tickets[0]->id,
                $tickets[1]->id,
            ),
        ));

    }

    public function testUpdateseatrankfortickets() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $listparams = new EventQuery(array(
            "filter" => "select id from tm.event where seatingplanid is not null and id < 777800",
            "limit" => 1,
            "orderby" => "name",
            "output" => "ids",
        ));
        $list = Events::getlist($client, $listparams);

        $this->assertGreaterThan(0, count($list->data));

        $stream = Events::gettickets($client, $list->data[0]->id, null);

        $tickets = array();
        while($ticketsitem = $stream->next()) {
            $tickets[] = $ticketsitem;
        }

        $this->assertGreaterThan(0, count($tickets));

        Events::updateseatrankfortickets($client, $list->data[0]->id, array(
            "seatrankid" => 3,
            "ticketids" => array(
                $tickets[0]->id,
                $tickets[1]->id,
            ),
        ));

    }

}
