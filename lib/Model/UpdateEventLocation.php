<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateEventLocation implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Name of the location
     *
     * @var string
     */
    public $name;

    /**
     * Street name
     *
     * @var string
     */
    public $street1;

    /**
     * Nr. + Box
     *
     * @var string
     */
    public $street2;

    /**
     * Zipcode
     *
     * @var string
     */
    public $zip;

    /**
     * City
     *
     * @var string
     */
    public $city;

    /**
     * Country code. Should be an ISO 3166-1 alpha-2 (http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
     * two-letter code.
     *
     * @var string
     */
    public $countrycode;

    /**
     * Unpack UpdateEventLocation from JSON.
     *
     * @return UpdateEventLocation
     */
    public static function fromJson($obj) {
        return new UpdateEventLocation(array(
            "name" => $obj->name,
            "street1" => $obj->street1,
            "street2" => $obj->street2,
            "zip" => $obj->zip,
            "city" => $obj->city,
            "countrycode" => $obj->countrycode,
        ));
    }

    /**
     * Serialize UpdateEventLocation to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->street1)) {
                $result["street1"] = strval($this->street1);
            }
            if (!is_null($this->street2)) {
                $result["street2"] = strval($this->street2);
            }
            if (!is_null($this->zip)) {
                $result["zip"] = strval($this->zip);
            }
            if (!is_null($this->city)) {
                $result["city"] = strval($this->city);
            }
            if (!is_null($this->countrycode)) {
                $result["countrycode"] = strval($this->countrycode);
            }

        }
        return $result;
    }
}
