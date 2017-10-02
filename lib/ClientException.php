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

namespace Ticketmatic;

/**
 * API Client exception
 */
class ClientException extends \Exception {
    public $applicationcode;
    public $applicationdata;

    /**
     * Create a new ClientException.
     *
     * @param int $code
     * @param string $output
     */
    public function __construct($code, $output) {
        $obj = @json_decode($output);
        if ($obj !== null && isset($obj->code) && isset($obj->message)) {
            if (isset($obj->applicationdata)) {
                $this->applicationdata = $obj->applicationdata;
            }
            if (isset($obj->applicationcode)) {
                $this->applicationcode = $obj->applicationcode;
            }
            parent::__construct($obj->message, $obj->code);
        } else {
            // Can't decode or unexpected payload, pass it through
            parent::__construct($output, $code);
        }
    }
}
