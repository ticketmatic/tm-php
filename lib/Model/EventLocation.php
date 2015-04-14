<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class EventLocation implements \jsonSerializable
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
     * Convert EventLocation to UpdateEventLocation
     *
     * @return UpdateEventLocation
     */
    public function toUpdate() {
        $result = new UpdateEventLocation();
        $result->name = $this->name;
        $result->street1 = $this->street1;
        $result->street2 = $this->street2;
        $result->zip = $this->zip;
        $result->city = $this->city;
        $result->countrycode = $this->countrycode;
        return $result;
    }

    /**
     * Unpack EventLocation from JSON.
     *
     * @return EventLocation
     */
    public static function fromJson($obj) {
        return new EventLocation(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "street1" => $obj->street1,
            "street2" => $obj->street2,
            "zip" => $obj->zip,
            "city" => $obj->city,
            "countrycode" => $obj->countrycode,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize EventLocation to JSON.
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
