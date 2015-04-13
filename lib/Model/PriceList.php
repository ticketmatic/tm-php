<?php
namespace Ticketmatic\Model;

class PriceList
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
     * @var PricelistPrices
     */
    public $prices;

    /**
     * @var bool
     */
    public $hasranks;

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
     * Convert PriceList to UpdatePriceList
     *
     * @return UpdatePriceList
     */
    public function toUpdate() {
        $result = new UpdatePriceList();
        $result->name = $this->name;
        $result->prices = $this->prices;
        $result->hasranks = $this->hasranks;
        return $result;
    }

}
