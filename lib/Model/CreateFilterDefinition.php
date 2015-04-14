<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class CreateFilterDefinition implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

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
     * Unpack CreateFilterDefinition from JSON.
     *
     * @return CreateFilterDefinition
     */
    public static function fromJson($obj) {
        return new CreateFilterDefinition(array(
            "typeid" => $obj->typeid,
            "description" => $obj->description,
            "sqlclause" => $obj->sqlclause,
            "filtertype" => $obj->filtertype,
            "checklistquery" => $obj->checklistquery,
        ));
    }

    /**
     * Serialize CreateFilterDefinition to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
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

        }
        return $result;
    }
}
