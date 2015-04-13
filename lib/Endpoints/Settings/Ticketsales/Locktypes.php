<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreateLockType;
use Ticketmatic\Model\LockType;
use Ticketmatic\Model\LockTypeParameters;
use Ticketmatic\Model\UpdateLockType;

class Locktypes
{

    /**
     * Get a list of lock types
     *
     * @param LockTypeParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListLockType[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new LockTypeParameters($params);
        }

    }

    /**
     * Get a single lock type
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return LockType
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new lock type
     *
     * @param CreateLockType|array $data
     *
     * @throws ClientException
     *
     * @return LockType
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreateLockType($data);
        }

    }

    /**
     * Modify an existing lock type
     *
     * @param int $id
     *
     * @param UpdateLockType|array $data
     *
     * @throws ClientException
     *
     * @return LockType
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdateLockType($data);
        }

    }

    /**
     * Remove a lock type
     *
     * Lock types are archivable: this call won't actually delete the object from the database.
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
     * Batch modify lock types
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
