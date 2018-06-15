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
use Ticketmatic\Endpoints\Contacts;
use Ticketmatic\Endpoints\Settings\System\Contactaddresstypes;
use Ticketmatic\Endpoints\Settings\System\Contacttitles;
use Ticketmatic\Endpoints\Settings\System\Phonenumbertypes;
use Ticketmatic\Model\BatchContactOperation;
use Ticketmatic\Model\Contact;
use Ticketmatic\Model\ContactGetQuery;
use Ticketmatic\Model\ContactIdReservation;
use Ticketmatic\Model\ContactImportStatus;
use Ticketmatic\Model\ContactQuery;

class ContactsTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $list = Contacts::getlist($client, null);

        $this->assertGreaterThan(0, count($list->data));

        $contact = Contacts::get($client, $list->data[0]->id, null);

        $this->assertEquals($list->data[0]->id, $contact->id);

    }

    public function testBatch() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "firstname" => "John",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);

        $contact2 = Contacts::create($client, array(
            "firstname" => "Bob",
        ));

        $this->assertNotEquals(0, $contact2->id);
        $this->assertEquals("Bob", $contact2->firstname);

        Contacts::batch($client, array(
            "ids" => array(
                $contact->id,
            ),
            "operation" => "update",
            "parameters" => array(
                "fields" => array(
                    "languagecode" => "EN",
                ),
            ),
        ));

        $this->assertNotEquals(null, $batchupdate);

    }

    public function testCreate() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "firstname" => "John",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);

        $updated = Contacts::update($client, $contact->id, array(
            "lastname" => "Doe",
        ));

        $this->assertEquals($contact->id, $updated->id);
        $this->assertEquals("John", $updated->firstname);
        $this->assertEquals("Doe", $updated->lastname);

        Contacts::delete($client, $contact->id);

    }

    public function testCreatecustom() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $titles = Contacttitles::getlist($client, null);

        $this->assertGreaterThan(0, count($titles->data));

        $addrtypes = Contactaddresstypes::getlist($client, null);

        $this->assertGreaterThan(0, count($addrtypes->data));

        $ptypes = Phonenumbertypes::getlist($client, null);

        $this->assertGreaterThan(1, count($ptypes->data));

        $contact = Contacts::create($client, array(
            "addresses" => array(
                array(
                    "city" => "Nieuwerkerk Aan Den Ijssel",
                    "countrycode" => "NL",
                    "street1" => "Kerkstraat",
                    "street2" => "1",
                    "typeid" => $addrtypes->data[0]->id,
                    "zip" => "2914 AH",
                ),
            ),
            "birthdate" => "1959-09-21",
            "customertitleid" => $titles->data[0]->id,
            "email" => "john@worldonline.nl",
            "firstname" => "John",
            "lastname" => "Johns",
            "middlename" => "J",
            "phonenumbers" => array(
                array(
                    "number" => "+31222222222",
                    "typeid" => $ptypes->data[0]->id,
                ),
                array(
                    "number" => "+31222222222",
                    "typeid" => $ptypes->data[1]->id,
                ),
            ),
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);
        $this->assertEquals("NL", $contact->addresses[0]->countrycode);
        $this->assertEquals("Netherlands", $contact->addresses[0]->country);

        Contacts::delete($client, $contact->id);

    }

    public function testCreateunicode() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "email" => "john@test.com",
            "firstname" => "JØhñ",
            "lastname" => "ポテト 👌 ไก่",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("JØhñ", $contact->firstname);
        $this->assertEquals("ポテト 👌 ไก่", $contact->lastname);

        $contact2 = Contacts::get($client, $contact->id, null);

        $this->assertNotEquals(0, $contact2->id);
        $this->assertEquals("JØhñ", $contact2->firstname);
        $this->assertEquals("ポテト 👌 ไก่", $contact2->lastname);

        $contact3params = new ContactGetQuery(array(
            "email" => "john@test.com",
        ));
        $contact3 = Contacts::get($client, 0, $contact3params);

        $this->assertNotEquals(0, $contact3->id);

        Contacts::delete($client, $contact->id);

    }

    public function testArchived() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "firstname" => "John",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);

        $reqparams = new ContactQuery(array(
            "includearchived" => true,
        ));
        $req = Contacts::getlist($client, $reqparams);

        $this->assertGreaterThan(0, count($req->data));

        Contacts::delete($client, $contact->id);

        $req2 = Contacts::getlist($client, null);

        $this->assertGreaterThan(count($req2->data), count($req->data));

        $req3params = new ContactQuery(array(
            "includearchived" => true,
        ));
        $req3 = Contacts::getlist($client, $req3params);

        $this->assertEquals(count($req3->data), count($req->data));

    }

    public function testImport() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contacts = Contacts::import($client, array(
            array(
                "firstname" => "Test",
                "lastname" => "Mc Cheer",
            ),
            array(
                "email" => "invalid",
                "firstname" => "Last",
            ),
        ));

        $this->assertEquals(true, $contacts[0]->ok);
        $this->assertEquals(false, $contacts[1]->ok);
        $this->assertGreaterThan(0, $contacts[0]->id);
        $this->assertEquals("Invalid email", $contacts[1]->error);

        Contacts::delete($client, $contacts[0]->id);

    }

    public function testAccount() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "email" => "john@test.com",
            "firstname" => "John",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);
        $this->assertEquals("john@test.com", $contact->email);

        $updated = Contacts::createaccount($client, $contact->id);

        $this->assertEquals($contact->id, $updated->id);
        $this->assertEquals(1901, $updated->account_type);

        Contacts::resetpassword($client, $contact->id);

        $deleted = Contacts::deleteaccount($client, $contact->id);

        $this->assertEquals($contact->id, $deleted->id);
        $this->assertEquals(0, $deleted->account_type);

    }

    public function testUpdatewithoptins() {
        $accountcode = $_SERVER["TM_TEST_ACCOUNTCODE"];
        $accesskey = $_SERVER["TM_TEST_ACCESSKEY"];
        $secretkey = $_SERVER["TM_TEST_SECRETKEY"];
        $client = new Client($accountcode, $accesskey, $secretkey);

        $contact = Contacts::create($client, array(
            "email" => "john34@test.com",
            "firstname" => "John",
        ));

        $this->assertNotEquals(0, $contact->id);
        $this->assertEquals("John", $contact->firstname);
        $this->assertEquals("john34@test.com", $contact->email);
        $this->assertEquals(0, count($contact->optins));

        $updated = Contacts::update($client, $contact->id, array(
            "optins" => array(
                array(
                    "info" => array(
                        "method" => "api",
                        "remarks" => "remarks",
                    ),
                    "optinid" => 1,
                    "status" => 7602,
                ),
            ),
        ));

        $this->assertEquals($contact->id, $updated->id);
        $this->assertEquals(1, count($updated->optins));
        $this->assertEquals(1, $updated->optins[0]->optinid);
        $this->assertEquals($contact->id, $updated->optins[0]->contactid);
        $this->assertEquals(7602, $updated->optins[0]->status);
        $this->assertEquals("api", $updated->optins[0]->info->method);
        $this->assertEquals("remarks", $updated->optins[0]->info->remarks);

    }

}
