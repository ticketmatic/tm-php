<?php
namespace Ticketmatic\Model;

class UpdateWebSalesSkin
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

}
