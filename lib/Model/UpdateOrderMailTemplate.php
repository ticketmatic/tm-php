<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateOrderMailTemplate implements \jsonSerializable
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
     * Unpack UpdateOrderMailTemplate from JSON.
     *
     * @return UpdateOrderMailTemplate
     */
    public static function fromJson($obj) {
        return new UpdateOrderMailTemplate(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "subject" => $obj->subject,
            "body" => $obj->body,
            "translations" => Json::unpackArray("string", $obj->translations),
        ));
    }

    /**
     * Serialize UpdateOrderMailTemplate to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = $this->typeid;
            }
            if (!is_null($this->subject)) {
                $result["subject"] = $this->subject;
            }
            if (!is_null($this->body)) {
                $result["body"] = $this->body;
            }
            if (!is_null($this->translations)) {
                $result["translations"] = $this->translations;
            }

        }
        return $result;
    }
}
