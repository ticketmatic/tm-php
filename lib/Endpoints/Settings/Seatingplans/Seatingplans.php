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

namespace Ticketmatic\Endpoints\Settings\Seatingplans;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\LockTemplate;
use Ticketmatic\Model\LogicalPlan;
use Ticketmatic\Model\SeatDescriptionTemplate;
use Ticketmatic\Model\SeatingPlan;
use Ticketmatic\Model\SeatingPlanQuery;

/**
 * A seating plan describes the structural layout of an event location and allows
 * for buying tickets for numbered seats.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_seatingplans_seatingplans).
 */
class Seatingplans
{

    /**
     * Get a list of seating plans
     *
     * @param Client $client
     * @param \Ticketmatic\Model\SeatingPlanQuery|array $params
     *
     * @throws ClientException
     *
     * @return SeatingplansList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new SeatingPlanQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans");

        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run();
        return SeatingplansList::fromJson($result);
    }

    /**
     * Get a single seating plan
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\SeatingPlan
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return SeatingPlan::fromJson($result);
    }

    /**
     * Create a new seating plan
     *
     * @param Client $client
     * @param \Ticketmatic\Model\SeatingPlan|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\SeatingPlan
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new SeatingPlan($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans");
        $req->setBody($data);

        $result = $req->run();
        return SeatingPlan::fromJson($result);
    }

    /**
     * Modify an existing seating plan
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\SeatingPlan|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\SeatingPlan
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new SeatingPlan($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/seatingplans/seatingplans/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return SeatingPlan::fromJson($result);
    }

    /**
     * Remove a seating plan
     *
     * Seating plans are archivable: this call won't actually delete the object from
     * the database. Instead, it will mark the object as archived, which means it won't
     * show up anymore in most places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure
     * consistency of historical data.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/seatingplans/seatingplans/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Get the svg for a specific zone
     *
     * Returns the svg for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     *
     * @throws ClientException
     */
    public static function getsvg(Client $client, $id, $zoneid) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}/svg/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);


        $req->run();
    }

    /**
     * Update the svg for a specific zone
     *
     * Updates the svg for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     * @param string|array $data
     *
     * @throws ClientException
     */
    public static function savesvg(Client $client, $id, $zoneid, $data) {
        if ($data == null || is_array($data)) {
            $d = new string($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/svg/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);

        $req->setBody($data);

        $req->run();
    }

    /**
     * Get the rendered svg for a specific zone
     *
     * Returns the rendered svg for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     *
     * @throws ClientException
     */
    public static function getrenderedsvg(Client $client, $id, $zoneid) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}/renderedsvg/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);


        $req->run();
    }

    /**
     * Update the rendered svg for a specific zone
     *
     * Updates the rendered svg for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     * @param string|array $data
     *
     * @throws ClientException
     */
    public static function saverenderedsvg(Client $client, $id, $zoneid, $data) {
        if ($data == null || is_array($data)) {
            $d = new string($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/renderedsvg/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);

        $req->setBody($data);

        $req->run();
    }

    /**
     * Update the source svg for a specific zone
     *
     * Updates the source svg for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     * @param string|array $data
     *
     * @throws ClientException
     */
    public static function savesourcesvg(Client $client, $id, $zoneid, $data) {
        if ($data == null || is_array($data)) {
            $d = new string($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/sourcesvg/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);

        $req->setBody($data);

        $req->run();
    }

    /**
     * Get the lock templates
     *
     * Returns the lock templates for this seating plan.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LockTemplate[]
     */
    public static function getlocktemplates(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}/locktemplates");
        $req->addParameter("id", $id);


        $result = $req->run();
        return Json::unpackArray("LockTemplate", $result);
    }

    /**
     * Save the lock templates
     *
     * Save the lock templates for this seating plan.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\LockTemplate[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LockTemplate[]
     */
    public static function savelocktemplates(Client $client, $id, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new LockTemplate($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/locktemplates");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Json::unpackArray("LockTemplate", $result);
    }

    /**
     * Get the seat description templates
     *
     * Returns the seat description templates for this seating plan.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\SeatDescriptionTemplate[]
     */
    public static function getseatdescriptiontemplates(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}/seatdescriptiontemplates");
        $req->addParameter("id", $id);


        $result = $req->run();
        return Json::unpackArray("SeatDescriptionTemplate", $result);
    }

    /**
     * Save the seat description templates
     *
     * Save the seat description templates for this seating plan.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\SeatDescriptionTemplate[]|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\SeatDescriptionTemplate[]
     */
    public static function saveseatdescriptiontemplates(Client $client, $id, array $data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $d = new SeatDescriptionTemplate($value);
                $data[$key] = $d->jsonSerialize();
            }
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/locktemplates");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Json::unpackArray("SeatDescriptionTemplate", $result);
    }

    /**
     * Get the logical plan for a specific zone
     *
     * Returns the logical plan for this specific zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LogicalPlan
     */
    public static function getlogicalplan(Client $client, $id, $zoneid) {
        $req = $client->newRequest("GET", "/{accountname}/settings/seatingplans/seatingplans/{id}/logicalplan/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);


        $result = $req->run();
        return LogicalPlan::fromJson($result);
    }

    /**
     * Update the logical plan for this zone.
     *
     * Updates the logical plan for this zone.
     *
     * @param Client $client
     * @param int $id
     * @param string $zoneid
     * @param \Ticketmatic\Model\LogicalPlan|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\LogicalPlan
     */
    public static function savelogicalplan(Client $client, $id, $zoneid, $data) {
        if ($data == null || is_array($data)) {
            $d = new LogicalPlan($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/seatingplans/seatingplans/{id}/logicalplan/{zoneid}");
        $req->addParameter("id", $id);

        $req->addParameter("zoneid", $zoneid);

        $req->setBody($data);

        $result = $req->run();
        return LogicalPlan::fromJson($result);
    }
}
