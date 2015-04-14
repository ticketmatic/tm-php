<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class OrderMailTemplate implements \jsonSerializable
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

    /**
     * Unpack OrderMailTemplate from JSON.
     *
     * @return OrderMailTemplate
     */
    public static function fromJson($obj) {
        return new OrderMailTemplate(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "subject" => $obj->subject,
            "body" => $obj->body,
            "translations" => Json::unpackArray("string", $obj->translations),
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize OrderMailTemplate to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = intval($this->id);
            }
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->subject)) {
                $result["subject"] = strval($this->subject);
            }
            if (!is_null($this->body)) {
                $result["body"] = strval($this->body);
            }
            if (!is_null($this->translations)) {
                $result["translations"] = $this->translations;
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
