<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateWebSalesSkin implements \jsonSerializable
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
     * @var string
     */
    public $html;

    /**
     * @var string
     */
    public $css;

    /**
     * @var string[]
     */
    public $translations;

    /**
     * @var WebskinConfiguration
     */
    public $configuration;

    /**
     * Unpack UpdateWebSalesSkin from JSON.
     *
     * @return UpdateWebSalesSkin
     */
    public static function fromJson($obj) {
        return new UpdateWebSalesSkin(array(
            "name" => $obj->name,
            "html" => $obj->html,
            "css" => $obj->css,
            "translations" => Json::unpackArray("string", $obj->translations),
            "configuration" => WebskinConfiguration::fromJson($obj->configuration),
        ));
    }

    /**
     * Serialize UpdateWebSalesSkin to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->html)) {
                $result["html"] = $this->html;
            }
            if (!is_null($this->css)) {
                $result["css"] = $this->css;
            }
            if (!is_null($this->translations)) {
                $result["translations"] = $this->translations;
            }
            if (!is_null($this->configuration)) {
                $result["configuration"] = $this->configuration;
            }

        }
        return $result;
    }
}
