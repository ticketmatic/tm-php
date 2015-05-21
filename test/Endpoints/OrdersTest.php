<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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

namespace Ticketmatic\Test\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Orders;
use Ticketmatic\Model\AddTickets;
use Ticketmatic\Model\AddTicketsResult;
use Ticketmatic\Model\CreateOrder;
use Ticketmatic\Model\DeleteTickets;
use Ticketmatic\Model\Order;
use Ticketmatic\Model\OrderQuery;
use Ticketmatic\Model\UpdateOrder;
use Ticketmatic\Model\UpdateTickets;

class OrdersTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $listparams = new OrderQuery();
        $listparams->output = "withlookup";
        $list = Orders::getlist($client, $listparams);

        $this->assertGreaterThan(0, count($list->data));

        $order = Orders::get($client, $list->data[0]->orderid);

        $this->assertEquals($list->data[0]->orderid, $order->orderid);

    }

    public function testCreate() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $order = Orders::create($client, array(
            "saleschannelid" => 1,
        ));

        $this->assertNotEquals(0, $order->orderid);
        $this->assertEquals(1, $order->saleschannelid);

        $updated = Orders::update($client, $order->orderid, array(
            "customerid" => 777701,
            "deliveryscenarioid" => 2,
            "paymentscenarioid" => 3,
        ));

        $this->assertEquals($order->orderid, $updated->orderid);
        $this->assertEquals(2, $updated->deliveryscenarioid);
        $this->assertEquals(3, $updated->paymentscenarioid);
        $this->assertEquals(777701, $updated->customerid);

        $ticketsadded = Orders::addtickets($client, $order->orderid, array(
            "tickets" => array(
                array(
                    "tickettypepriceid" => 584,
                ),
                array(
                    "tickettypepriceid" => 584,
                ),
            ),
        ));

        $this->assertEquals(2, count($ticketsadded->order->tickets));

        $confirmed = Orders::confirm($client, $order->orderid);

        $ticketids = array(
            $ticketsadded->order->tickets[0]->id,
        );

        $updated2 = Orders::updatetickets($client, $order->orderid, array(
            "operation" => "setticketholders",
            "params" => array(
                "ticketholderids" => array(
                        777701,
                    ),
            ),
            "tickets" => $ticketids,
        ));

        $this->assertEquals(777701, $updated2->tickets[0]->ticketholderid);

        $deleted = Orders::deletetickets($client, $order->orderid, array(
            "tickets" => $ticketids,
        ));

        $this->assertEquals(1, count($deleted->tickets));

    }

}
