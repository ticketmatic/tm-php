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

namespace Ticketmatic\Endpoints;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\QueueStatus;

/**
 * Each account has a built-in rate limiter and may optionally use queues to
 * streamline the handling of peak sales. These rate limiters are also applicable
 * to the API: order creation (and ticket assignment) is limited globally for an
 * account, so a high demand on the web sales pages will also impact the available
 * capacity on the API (and vice-versa).
 *
 * This rate limiting can manifest itself when creating orders or when adding
 * tickets to an order: a response status of `429 Rate Limit Exceeded` will be
 * returned.
 *
 * The rate limiter works with 2 time intervals: per minute and per 5-second
 * interval. The allowed rate per 5-second interval is equal to the rate per minute
 * / 3. So for example: if the rate limit per minute is 60, the rate limit per 5
 * seconds is 20.
 *
 * ## Rate limiting in libraries
 *
 * ### Go
 *
 * A rate limited call will return a `RateLimitError`. This error has a `Backoff`
 * field which contains the number of seconds to wait before making a new request.
 *
 * ```go
 * _, err = orders.Create(c, &ticketmatic.CreateOrder{
 *     Events: []int64{
 *         777714,
 *     },
 *     Saleschannelid: 1,
 * })
 * if err != nil {
 *     if e, ok := err.(*ticketmatic.RateLimitError); ok {
 *         // Do something useful with e:
 *         return fmt.Errorf("Need to sleep for %d seconds\n", e.Backoff)
 *     } else {
 *         return err
 *     }
 * }
 * ```
 *
 * ### PHP
 *
 * A rate limited call will throw a `RateLimitException`. This exception has a
 * `backoff` field which contains the number of seconds to wait before making a new
 * request.
 *
 * ```php
 * try {
 *     $order = Orders::create($client, array(
 *         "events" => array(
 *             777714,
 *         ),
 *         "saleschannelid" => 1,
 *     ));
 * } catch (RateLimitException $ex) {
 *     $backoff = $ex->backoff;
 *     // Sleep for $backoff seconds before retrying.
 * }
 * ```
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/ratelimiting).
 */
class Ratelimiting
{

    /**
     * Request a status update
     *
     * Request a new rate limiting status update. See rate limiting (api/ratelimiting)
     * for more details on rate limiting.
     *
     * @param Client $client
     * @param string $queuetoken
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\QueueStatus
     */
    public static function status(Client $client, $queuetoken) {
        $req = $client->newRequest("POST", "/{accountname}/ratelimiting/status/{queuetoken}");
        $req->addParameter("queuetoken", $queuetoken);


        $result = $req->run("json");
        return QueueStatus::fromJson($result);
    }
}
