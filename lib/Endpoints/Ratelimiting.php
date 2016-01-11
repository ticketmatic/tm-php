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
 * @link        http://www.ticketmatic.com/
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
 * This article describes how you can detect and properly handle rate limiting.
 *
 * ## Detecting rate limiting
 *
 * As mentioned earlier, whenever the system detects excessive demand, it will
 * trigger a rate limit. When you create an order, the returned status will be `429
 * Rate Limit Exceeded`.
 *
 * Like web sales users, you will need to wait in a queue before you can proceed.
 * Once it's your turn, the system will create the requested order and allow you to
 * continue.
 *
 * A similar thing might happen when you try to add tickets to an order: the
 * requested event (or product) might be rate limited and a `429` will be returned.
 *
 * **Key take-away:** Always check the response status of "order creation" and "add
 * tickets" calls, be prepared to handle a `429 Rate Limit Exceeded` response.
 *
 * ## Waiting in a rate limiter queue
 *
 * Whenever an operation is refused due to rate limiting, you **MUST** wait in the
 * rate limiting queue before retrying the operation or continuing further actions.
 *
 * If you do not correctly request status updates, the order will be considered
 * abandoned. **Simply retrying your operation at some point in the future will not
 * work and will cause more throttling.**
 *
 * The body of a `429 Rate Limit Exceeded` response contains all the data needed to
 * handle rate limiting. Here's an example:
 *
 * ```js
 * {
 *   "id": "fa37e57a-5614-4726-9a53-89155424f82d",
 *   "progress": 1,
 *   "backoff": 30000,
 *   "started": false,
 *   "starttime": "2018-12-12T22:00:00Z",
 *   "orderid": 621
 * }
 * ```
 *
 * The following fields are returned:
 *
 * * `id`: The queue ID, which you will need to poll for status updates
 *
 * * `progress`: The queue status, which will either be `1` (in progress) or `2`
 * (finished). You cannot proceed as long as this is 1.
 *
 * * `backoff`: Number of milliseconds to wait before requesting a new status
 * update. This will change dynamically based on where you are in the queue.
 *
 * * `started`: Whether the queue has started (as in: is progressing) or not (as
 * in: is waiting until a fixed time before starting).
 *
 * * `starttime`: When the queue will start. Only returned for queues that have not
 * started (`started == false`).
 *
 * * `ahead`: Number of people waiting in front of this request. Only returned for
 * queues that have started (`started == true`, not shown above).
 *
 * * `orderid`: The ID of the newly created order. Only returned when a create
 * order operation was rate limited and subsequently progressed through the queue.
 * This can be used to retrieve the new order once progressed through the queue.
 *
 * When encountering a rate limiting response, you must:
 *
 * * Wait for the amount of time specified in `backoff`.
 *
 * * Request a new status.
 *
 * * If `progress == 1`: Return to (1) and repeat
 *
 * * If `progress == 2`: Continue with normal operations
 *
 * Requesting a new status is done by sending a `POST` request to
 * `/ratelimiting/status/{id}`
 * (https://apps.ticketmatic.com/#/knowledgebase/api/ratelimiting/status).
 *
 * Once the returned `progress` equals `2`, it is safe to proceed.
 *
 * If the throttled operation was "create order", you will not need to retry: the
 * order will have been created and is now ready to use. The order ID will be
 * supplied as part of the rate limiting status once `progress == 2`.
 *
 * If the throttle operation was "add tickets", you will need to retry the
 * operation: the tickets you requested initially will not have been added to the
 * basket when the call was rate-limited.
 *
 * ## Avoiding rate limiting on "add tickets"
 *
 * Rate limiting on "add tickets" may occur when there are specific queues active
 * for certain events. This means that you might get throttled despite having an
 * active order.
 *
 * This is not ideal: it means that users will get placed into a queue when they
 * try to add tickets. A much better experience would be to ensure that no rate
 * limiting will occur while selecting tickets.
 *
 * This can be done by passing the event and product IDs for which tickets might
 * end up in the order when creating the order.
 *
 * As an example: suppose you have a custom order page for events 324 and 452. Pass
 * these event IDs when creating the order:
 *
 * ```js
 * {
 *     "saleschannelid": 1,
 *     "events": [324, 452]
 * }
 * ```
 *
 * If this operation gets rate limited, you will be given a rate limiter session
 * that guarantees that any "add tickets" calls for these events will succeed once
 * you progress through the queue.
 *
 * This is a much better user experience and thus *highly* recommended.
 *
 * ## Recommended implementation
 *
 * The recommended way to build a custom order page that handles rate limiting is
 * as follows:
 *
 * * When a user arrives that the order page, create an order with any possible
 * event and product IDs that might occur (see above).
 *
 * * If this simply returns an order, you will be certain that no further rate
 * limiting will occur, the user can now fill his/her basket.
 *
 * * If a `429 Rate Limit Exceeded` response is returned:
 *
 * * Show the user a page that explains that there is heavy demand (or that the
 * sales haven't started yet, depending on the `started` field).
 *
 * * Use JavaScript on this page to set a timeout for `backoff` milliseconds and
 * then request a new status with the supplied queue ID. You will need to foresee
 * an endpoint in your backend that calls the Ticketmatic API to request a new
 * queue status and returns it to the client.
 *
 * * Make sure you tell the user not to close his/her browser.
 *
 * This configuration has a number of advantages:
 *
 * * No additional rate limiting will happen once the order has been created.
 *
 * * No retry logic is needed on the server: the polling logic happens on the
 * client. As long as each user keeps his/her browser open, it will periodically
 * fetch new status updates.
 *
 * ## Rate limiting in libraries
 *
 * ### PHP
 *
 * A rate limited call will throw a `RateLimitException`. This exception has a
 * `data` field which contains the rate limiting info.
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
 *     $status = $ex->data;
 *     // Use $status to inform user about queue.
 *     // The queue ID needed for polling is in $status->id
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
     * Request a new rate limiting status update. See rate limiting
     * (https://apps.ticketmatic.com/#/knowledgebase/api/ratelimiting) for more details
     * on rate limiting.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\QueueStatus
     */
    public static function status(Client $client, $id) {
        $req = $client->newRequest("POST", "/{accountname}/ratelimiting/status/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return QueueStatus::fromJson($result);
    }
}
