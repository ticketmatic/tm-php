<?php
namespace Ticketmatic\Model;

class WebSalesSkin
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
     * Convert WebSalesSkin to UpdateWebSalesSkin
     *
     * @return UpdateWebSalesSkin
     */
    public function toUpdate() {
        $result = new UpdateWebSalesSkin();
        $result->name = $this->name;
        $result->html = $this->html;
        $result->css = $this->css;
        $result->translations = $this->translations;
        $result->configuration = $this->configuration;
        return $result;
    }

}
