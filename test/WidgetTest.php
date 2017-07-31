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

namespace Ticketmatic\Test;

use Ticketmatic\Widgets;

class WidgetTest extends \PHPUnit_Framework_TestCase {

    public function testSigning() {
        $w = new Widgets("club", "142dda885ec6024f934a40c1", "abd2e5893bd447dc7331af1db8df42fdc62fc5c8f9f04784");

        $url = $w->generateUrl("addtickets", array(
            "event"     => 123,
            "skinid"    => 25,
            "returnurl" => "http://www.ticketmatic.com",
            "l"         => "fr",
        ));

        // Strip the hostname
        $start = strpos($url, "/widgets");
        $url = substr($url, $start);

        $this->assertEquals($url, "/widgets/club/addtickets?event=123&skinid=25&returnurl=http%3A%2F%2Fwww.ticketmatic.com&l=fr&accesskey=142dda885ec6024f934a40c1&signature=ae727e02cea8c27322a24af487af950b4d8d26978e57151bfed7e356dd593c00");
    }
}
