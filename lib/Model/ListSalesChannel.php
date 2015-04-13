<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class ListSalesChannel implements \jsonSerializable
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
     * Name of the sales channel
     *
     * @var string
     */
    public $name;

    /**
     * The type of this sales channel, defines where this sales channel will be used.
     * The available values for this field can be found on the sales channel overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_saleschannels) page.
     *
     * @var int
     */
    public $typeid;

    /**
     * The ID of the order mail template to use for sending confirmations
     *
     * @var int
     */
    public $ordermailtemplateid_confirmation;

    /**
     * Always send the confirmation, regardless of the payment method configuration
     *
     * @var bool
     */
    public $ordermailtemplateid_confirmation_sendalways;

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
     * Unpack ListSalesChannel from JSON.
     *
     * @return ListSalesChannel
     */
    public static function fromJson($obj) {
        return new ListSalesChannel(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "ordermailtemplateid_confirmation" => $obj->ordermailtemplateid_confirmation,
            "ordermailtemplateid_confirmation_sendalways" => $obj->ordermailtemplateid_confirmation_sendalways,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListSalesChannel to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->id)) {
                $result["id"] = $this->id;
            }
            if (!is_null($this->name)) {
                $result["name"] = $this->name;
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = $this->typeid;
            }
            if (!is_null($this->ordermailtemplateid_confirmation)) {
                $result["ordermailtemplateid_confirmation"] = $this->ordermailtemplateid_confirmation;
            }
            if (!is_null($this->ordermailtemplateid_confirmation_sendalways)) {
                $result["ordermailtemplateid_confirmation_sendalways"] = $this->ordermailtemplateid_confirmation_sendalways;
            }
            if (!is_null($this->createdts)) {
                $result["createdts"] = Json::packTimestamp($this->createdts);
            }
            if (!is_null($this->lastupdatets)) {
                $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
            }
            if (!is_null($this->isarchived)) {
                $result["isarchived"] = $this->isarchived;
            }

        }
        return $result;
    }
}
