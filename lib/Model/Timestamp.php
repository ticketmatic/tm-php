<?php
namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * A timestamp returned by the diagnostic /time call
 * (https://apps.ticketmatic.com/#/knowledgebase/api/diagnostics/time).
 */
class Timestamp implements \jsonSerializable
{
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Current system time
     *
     * @var \DateTime
     */
    public $systemtime;

    /**
     * Unpack Timestamp from JSON.
     *
     * @return Timestamp
     */
    public static function fromJson($obj) {
        return new Timestamp(array(
            "systemtime" => Json::unpackTimestamp($obj->systemtime),
        ));
    }

    /**
     * Serialize Timestamp to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->systemtime)) {
                $result["systemtime"] = Json::packTimestamp($this->systemtime);
            }

        }
        return $result;
    }
}
