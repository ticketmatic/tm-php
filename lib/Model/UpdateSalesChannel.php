<?php
namespace Ticketmatic\Model;

class UpdateSalesChannel
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

}
