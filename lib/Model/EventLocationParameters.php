<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class EventLocationParameters implements \jsonSerializable
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
     * Unpack EventLocationParameters from JSON.
     *
     * @return EventLocationParameters
     */
    public static function fromJson($obj) {
        return new EventLocationParameters(array(
            "includearchived" => $obj->includearchived,
            "lastupdatesince" => Json::unpackTimestamp($obj->lastupdatesince),
            "filter" => $obj->filter,
        ));
    }

    /**
     * Serialize EventLocationParameters to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->includearchived)) {
                $result["includearchived"] = $this->includearchived;
            }
            if (!is_null($this->lastupdatesince)) {
                $result["lastupdatesince"] = Json::packTimestamp($this->lastupdatesince);
            }
            if (!is_null($this->filter)) {
                $result["filter"] = $this->filter;
            }

        }
        return $result;
    }
}
