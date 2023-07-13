<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * More info about order fees can be found here
 * (api/settings/ticketsales/orderfees).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderfeeAutoRule).
 */
class OrderfeeAutoRule implements \jsonSerializable
{
    /**
     * Create a new OrderfeeAutoRule
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The delivery scenarios that this order fee is applicable for. If not set
     * it defaults to 'all'. This is only needed if the order fee type is set to
     * automatic.
     *
     * @var int[]
     */
    public $deliveryscenarioids;

    /**
     * The payment scenarios that this order fee is applicable for. If not set it
     * default to 'all'. This is only needed if the order fee type is set to automatic.
     *
     * @var int[]
     */
    public $paymentscenarioids;

    /**
     * The sales channels that this order fee is applicable for. If not set it defaults
     * to 'all'. This is only needed if the order fee type is set to automatic.
     *
     * @var int[]
     */
    public $saleschannelids;

    /**
     * Can be `fixedfee` or `percentagefee`. Defauls to `fixedfee`. This is only needed
     * if the order fee type is set to automatic.
     *
     * @var string
     */
    public $status;

    /**
     * The value (amount) that will be added to the order. Is required if the order fee
     * type is set to automatic.
     *
     * @var float
     */
    public $value;

    /**
     * Unpack OrderfeeAutoRule from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderfeeAutoRule
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderfeeAutoRule(array(
            "deliveryscenarioids" => isset($obj->deliveryscenarioids) ? $obj->deliveryscenarioids : null,
            "paymentscenarioids" => isset($obj->paymentscenarioids) ? $obj->paymentscenarioids : null,
            "saleschannelids" => isset($obj->saleschannelids) ? $obj->saleschannelids : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "value" => isset($obj->value) ? $obj->value : null,
        ));
    }

    /**
     * Serialize OrderfeeAutoRule to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->deliveryscenarioids)) {
            $result["deliveryscenarioids"] = $this->deliveryscenarioids;
        }
        if (!is_null($this->paymentscenarioids)) {
            $result["paymentscenarioids"] = $this->paymentscenarioids;
        }
        if (!is_null($this->saleschannelids)) {
            $result["saleschannelids"] = $this->saleschannelids;
        }
        if (!is_null($this->status)) {
            $result["status"] = strval($this->status);
        }
        if (!is_null($this->value)) {
            $result["value"] = floatval($this->value);
        }

        return $result;
    }
}
