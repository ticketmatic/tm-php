<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
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
        if ($params == null || is_array($params)) {
            $params = new LockTypeParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/locktypes");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListLockType", $result);
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
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return LockType::fromJson($result);
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
        if ($data == null || is_array($data)) {
            $data = new CreateLockType($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/locktypes");
        $req->setBody($data);

        $result = $req->run();
        return LockType::fromJson($result);
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
        if ($data == null || is_array($data)) {
            $data = new UpdateLockType($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return LockType::fromJson($result);
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
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/locktypes/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify lock types
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/locktypes");

        $req->run();
    }
}
