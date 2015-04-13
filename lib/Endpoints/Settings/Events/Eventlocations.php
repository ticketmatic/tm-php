<?php
namespace Ticketmatic\Endpoints\Settings\Events;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateEventLocation;
use Ticketmatic\Model\EventLocation;
use Ticketmatic\Model\EventLocationParameters;
use Ticketmatic\Model\UpdateEventLocation;

/**
 * Events can be linked to an event location, which consists of a name and an address. The event
 * location is typically included on the ticket layout, to help your audience arrive at the right
 * location.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_events_eventlocations).
 */
class Eventlocations
{

    /**
     * Get a list of event locations
     *
     * @param EventLocationParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListEventLocation[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new EventLocationParameters($params);
        }

    }

    /**
     * Get a single event location
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return EventLocation
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new event location
     *
     * @param CreateEventLocation|array $data
     *
     * @throws ClientException
     *
     * @return EventLocation
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateEventLocation($data);
        }

    }

    /**
     * Modify an existing event location
     *
     * @param int $id
     *
     * @param UpdateEventLocation|array $data
     *
     * @throws ClientException
     *
     * @return EventLocation
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateEventLocation($data);
        }

    }

    /**
     * Remove an event location
     *
     * Event locations are archivable: this call won't actually delete the object from the database.
     * Instead, it will mark the object as archived, which means it won't show up anymore in most
     * places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure consistency of
     * historical data.
     *
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {


    }

    /**
     * Batch modify event locations
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
