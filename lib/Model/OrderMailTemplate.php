<?php
namespace Ticketmatic\Model;

class OrderMailTemplate
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
     * @var int
     */
    public $typeid;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $body;

    /**
     * @var string[]
     */
    public $translations;

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
     * Convert OrderMailTemplate to UpdateOrderMailTemplate
     *
     * @return UpdateOrderMailTemplate
     */
    public function toUpdate() {
        $result = new UpdateOrderMailTemplate();
        $result->name = $this->name;
        $result->typeid = $this->typeid;
        $result->subject = $this->subject;
        $result->body = $this->body;
        $result->translations = $this->translations;
        return $result;
    }

}
