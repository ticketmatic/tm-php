<?php
namespace Ticketmatic\Model;

class EventLocation
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

}
