<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdatePriceList implements \jsonSerializable
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
     * Unpack UpdatePriceList from JSON.
     *
     * @return UpdatePriceList
     */
    public static function fromJson($obj) {
        return new UpdatePriceList(array(
            "name" => $obj->name,
            "prices" => PricelistPrices::fromJson($obj->prices),
            "hasranks" => $obj->hasranks,
        ));
    }

    /**
     * Serialize UpdatePriceList to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->prices)) {
                $result["prices"] = $this->prices;
            }
            if (!is_null($this->hasranks)) {
                $result["hasranks"] = $this->hasranks;
            }

        }
        return $result;
    }
}
