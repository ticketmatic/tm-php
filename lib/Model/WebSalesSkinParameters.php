<?php
namespace Ticketmatic\Model;

class WebSalesSkinParameters
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * All items that were updated since this timestamp will be returned. Timestamp should be passed
     * in YYYY-MM-DD hh:mm:ss format.
     *
     * @var \DateTime
     */
    public $lastupdatesince;

    /**
     * Filter the returned items by specifying a query on the public datamodel that returns the ids.
     *
     * @var string
     */
    public $filter;

}
