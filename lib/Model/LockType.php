<?php
namespace Ticketmatic\Model;

class LockType
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
     * @var bool
     */
    public $ishardlock;

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
     * Convert LockType to UpdateLockType
     *
     * @return UpdateLockType
     */
    public function toUpdate() {
        $result = new UpdateLockType();
        $result->name = $this->name;
        $result->ishardlock = $this->ishardlock;
        return $result;
    }

}
