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

namespace Ticketmatic\Test\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Settings\Ticketsales\Orderfees;
use Ticketmatic\Model\OrderFee;
use Ticketmatic\Model\OrderFeeQuery;

class OrderfeesTest extends \PHPUnit_Framework_TestCase {

    public function testCreateAndDelete() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $orderfee = Orderfees::create($client, array(
            "name" => "Order fee test",
            "rule" => array(
                "auto" => array(
                    array(
                        "deliveryscenarioids" => array(
                            1,
                        ),
                        "paymentscenarioids" => array(
                            1,
                        ),
                        "saleschannelids" => array(
                            1,
                        ),
                        "status" => "fixedfee",
                        "value" => 1,
                    ),
                ),
            ),
            "typeid" => 2401,
        ));

        $this->assertNotEquals(0, $orderfee->id);
        $this->assertEquals(2401, $orderfee->typeid);
        $this->assertEquals("Order fee test", $orderfee->name);

        $orderfeescript = Orderfees::create($client, array(
            "name" => "Order fee script test",
            "rule" => array(
                "context" => array(
                    array(
                        "cacheable" => true,
                        "key" => "test",
                        "query" => "select 27 as nbroftickets",
                    ),
                ),
                "script" => "return 2;",
            ),
            "typeid" => 2402,
        ));

        $this->assertNotEquals(0, $orderfeescript->id);
        $this->assertEquals(2402, $orderfeescript->typeid);
        $this->assertEquals("Order fee script test", $orderfeescript->name);
        $this->assertEquals("return 2;", $orderfeescript->rule->script);
        $this->assertEquals("test", $orderfeescript->rule->context[0]->key);
        $this->assertEquals("select 27 as nbroftickets", $orderfeescript->rule->context[0]->query);

        $list = Orderfees::getlist($client, null);

        $this->assertGreaterThan(1, count($list->data));

        Orderfees::delete($client, $orderfee->id);

        Orderfees::delete($client, $orderfeescript->id);

    }

}
