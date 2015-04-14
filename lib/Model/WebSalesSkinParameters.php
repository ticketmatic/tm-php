<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class WebSalesSkinParameters implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * All items that were updated since this timestamp will be returned. Timestamp should be passed
     * in YYYY-MM-DD hh:mm:ss format.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Filter the returned items by specifying a query on the public datamodel that returns the ids.
     *
     * @var string
     */
    public $filter;

    /**
     * Unpack WebSalesSkinParameters from JSON.
     *
     * @return WebSalesSkinParameters
     */
    public static function fromJson($obj) {
        return new WebSalesSkinParameters(array(
            "lastupdatesince" => Json::unpackTimestamp($obj->lastupdatesince),
            "filter" => $obj->filter,
        ));
    }

    /**
     * Serialize WebSalesSkinParameters to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->lastupdatesince)) {
                $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
            }
            if (!is_null($this->filter)) {
                $result["filter"] = strval($this->filter);
            }

        }
        return $result;
    }
}
