<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class FilterDefinitionParameters implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If this parameter is true, archived items will be returned as well.
     *
     * @var bool
     */
    public $includearchived;

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
     * Only return items with the given typeid.
     *
     * @var int
     */
    public $typeid;

    /**
     * Unpack FilterDefinitionParameters from JSON.
     *
     * @return FilterDefinitionParameters
     */
    public static function fromJson($obj) {
        return new FilterDefinitionParameters(array(
            "includearchived" => $obj->includearchived,
            "lastupdatesince" => Json::unpackTimestamp($obj->lastupdatesince),
            "filter" => $obj->filter,
            "typeid" => $obj->typeid,
        ));
    }

    /**
     * Serialize FilterDefinitionParameters to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->includearchived)) {
                $result["includearchived"] = boolval($this->includearchived);
            }
            if (!is_null($this->lastupdatesince)) {
                $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
            }
            if (!is_null($this->filter)) {
                $result["filter"] = strval($this->filter);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }

        }
        return $result;
    }
}
