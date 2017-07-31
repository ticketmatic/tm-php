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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Test\Endpoints\Settings;

use Ticketmatic\Client;
use Ticketmatic\Endpoints\Settings\Vouchers;
use Ticketmatic\Model\AddVoucherCodes;
use Ticketmatic\Model\Voucher;
use Ticketmatic\Model\VoucherCode;
use Ticketmatic\Model\VoucherQuery;

class VouchersTest extends \PHPUnit_Framework_TestCase {

    public function testCreatecodes() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $codes = Vouchers::createcodes($client, 2, array(
            "amount" => 10,
            "count" => 3,
        ));

        $this->assertEquals(3, count($codes));
        $this->assertNotEquals("", $codes[0]->code);

        $voucher = Vouchers::get($client, 2);

        $this->assertEquals(2, $voucher->id);
        $this->assertGreaterThan(0, $voucher->nbrofcodes);

        Vouchers::deactivatecodes($client, 2, array(
            array(
                "code" => $codes[1]->code,
            ),
        ));

    }

    public function testValidity() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $voucher = Vouchers::create($client, array(
            "codeformatid" => 27001,
            "name" => "test",
            "typeid" => 24001,
            "validity" => array(
                "expiry_monthsaftercreation" => 12,
                "maxusages" => 5,
            ),
        ));

        $this->assertEquals(12, $voucher->validity->expiry_monthsaftercreation);
        $this->assertEquals(5, $voucher->validity->maxusages);

    }

}
