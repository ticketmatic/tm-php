<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class PriceList implements \jsonSerializable
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
     * @var PricelistPrices
     */
    public $prices;

    /**
     * @var bool
     */
    public $hasranks;

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
     * Whether or not this item is archived
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Convert PriceList to UpdatePriceList
     *
     * @return UpdatePriceList
     */
    public function toUpdate() {
        $result = new UpdatePriceList();
        $result->name = $this->name;
        $result->prices = $this->prices;
        $result->hasranks = $this->hasranks;
        return $result;
    }

    /**
     * Unpack PriceList from JSON.
     *
     * @return PriceList
     */
    public static function fromJson($obj) {
        return new PriceList(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "prices" => PricelistPrices::fromJson($obj->prices),
            "hasranks" => $obj->hasranks,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize PriceList to JSON.
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
            if (!is_null($this->prices)) {
                $result["prices"] = $this->prices;
            }
            if (!is_null($this->hasranks)) {
                $result["hasranks"] = $this->hasranks;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = $this->isarchived;
            }

        }
        return $result;
    }
}
