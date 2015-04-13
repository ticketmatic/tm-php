<?php
namespace Ticketmatic\Model;

class ListSalesChannel
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

}
