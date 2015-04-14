<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

class UpdateSalesChannel implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

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
     * Unpack UpdateSalesChannel from JSON.
     *
     * @return UpdateSalesChannel
     */
    public static function fromJson($obj) {
        return new UpdateSalesChannel(array(
            "name" => $obj->name,
            "typeid" => $obj->typeid,
            "ordermailtemplateid_confirmation" => $obj->ordermailtemplateid_confirmation,
            "ordermailtemplateid_confirmation_sendalways" => $obj->ordermailtemplateid_confirmation_sendalways,
        ));
    }

    /**
     * Serialize UpdateSalesChannel to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->ordermailtemplateid_confirmation)) {
                $result["ordermailtemplateid_confirmation"] = intval($this->ordermailtemplateid_confirmation);
            }
            if (!is_null($this->ordermailtemplateid_confirmation_sendalways)) {
                $result["ordermailtemplateid_confirmation_sendalways"] = boolval($this->ordermailtemplateid_confirmation_sendalways);
            }

        }
        return $result;
    }
}
