<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreatePriceList implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

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
     * Unpack CreatePriceList from JSON.
     *
     * @return CreatePriceList
     */
    public static function fromJson($obj) {
        return new CreatePriceList(array(
            "name" => $obj->name,
            "prices" => PricelistPrices::fromJson($obj->prices),
            "hasranks" => $obj->hasranks,
        ));
    }

    /**
     * Serialize CreatePriceList to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->prices)) {
                $result["prices"] = $this->prices;
            }
            if (!is_null($this->hasranks)) {
                $result["hasranks"] = boolval($this->hasranks);
            }

        }
        return $result;
    }
}
