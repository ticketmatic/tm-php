<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListWebSalesSkin implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * Created timestamp
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack ListWebSalesSkin from JSON.
     *
     * @return ListWebSalesSkin
     */
    public static function fromJson($obj) {
        return new ListWebSalesSkin(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
        ));
    }

    /**
     * Serialize ListWebSalesSkin to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = $this->id;
            }
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }

        }
        return $result;
    }
}
