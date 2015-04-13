<?php
namespace Ticketmatic\Model;

class FilterDefinition
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
     * Convert FilterDefinition to UpdateFilterDefinition
     *
     * @return UpdateFilterDefinition
     */
    public function toUpdate() {
        $result = new UpdateFilterDefinition();
        $result->description = $this->description;
        $result->sqlclause = $this->sqlclause;
        $result->filtertype = $this->filtertype;
        $result->checklistquery = $this->checklistquery;
        return $result;
    }

}
