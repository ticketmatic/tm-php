<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListFilterDefinition implements \jsonSerializable
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
     * Type ID
     *
     * @var int
     */
    public $typeid;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $sqlclause;

    /**
     * @var int
     */
    public $filtertype;

    /**
     * @var string
     */
    public $checklistquery;

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
     * Unpack ListFilterDefinition from JSON.
     *
     * @return ListFilterDefinition
     */
    public static function fromJson($obj) {
        return new ListFilterDefinition(array(
            "id" => $obj->id,
            "typeid" => $obj->typeid,
            "description" => $obj->description,
            "sqlclause" => $obj->sqlclause,
            "filtertype" => $obj->filtertype,
            "checklistquery" => $obj->checklistquery,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListFilterDefinition to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->description)) {
                $result["description"] = strval($this->description);
            }
            if (!is_null($this->sqlclause)) {
                $result["sqlclause"] = strval($this->sqlclause);
            }
            if (!is_null($this->filtertype)) {
                $result["filtertype"] = intval($this->filtertype);
            }
            if (!is_null($this->checklistquery)) {
                $result["checklistquery"] = strval($this->checklistquery);
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = boolval($this->isarchived);
            }

        }
        return $result;
    }
}
