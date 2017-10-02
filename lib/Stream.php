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
 * Streaming API response
 */
class Stream {
    /**
     * Request handle
     *
     * @var resource
     */
    private $c;

    /**
     * Async requests handle
     *
     * @var resource
     */
    private $mh;

    /**
     * Output buffer
     *
     * @var string
     */
    private $buffer;

    /**
     * Finished
     *
     * @var bool
     */
    private $finished;

    /**
     * Start a new streaming request
     *
     * @param resource $c
     */
    public function __construct($c) {
        $this->c = $c;
        $this->mh = curl_multi_init();
        $this->buffer = "";
        $this->finished = false;

        curl_setopt($this->c, CURLOPT_WRITEFUNCTION, array($this, "handleData"));

        curl_multi_add_handle($this->mh, $this->c);
    }

    function __destruct() {
        curl_multi_remove_handle($this->mh, $this->c);
        curl_multi_close($this->mh);
    }

    protected function handleData($ch, $data) {
        $this->buffer .= $data;
        return strlen($data);
    }

    /**
     * Get the next result
     */
    public function next() {
        // Fetch data until we have a newline.
        $this->receive();

        // No more newlines? We're done!
        $nl = strpos($this->buffer, "\n");
        if ($nl === false) {
            return false;
        }

        // Grab the first line
        $line = trim(substr($this->buffer, 0, $nl));
        $this->buffer = substr($this->buffer, $nl + 1);

        // Decode it, if there's any data
        if (strlen($line) == 0) {
            return false;
        }
        return json_decode($line);
    }

    /**
     * Pull more data from the stream
     */
    private function receive() {
        $nl = strpos($this->buffer, "\n");
        while ($nl === false && !$this->finished) {
            curl_multi_exec($this->mh, $running);
            curl_multi_select($this->mh);
            Request::checkError($this->c, $this->buffer);
            if ($running == 0) {
                $this->finished = true;
            }
            $nl = strpos($this->buffer, "\n");
        }
    }
}
