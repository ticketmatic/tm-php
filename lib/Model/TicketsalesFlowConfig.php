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
 * Config for a ticket sales flow
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/TicketsalesFlowConfig).
 */
class TicketsalesFlowConfig implements \jsonSerializable
{
    /**
     * Create a new TicketsalesFlowConfig
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Start timestamp for this config
     *
     * @var \DateTime
     */
    public $from;

    /**
     * End timestamp for this config
     *
     * @var \DateTime
     */
    public $until;

    /**
     * Widget to use in this config
     *
     * @var string
     */
    public $widget;

    /**
     * Widget parameters for this config
     *
     * @var string[]
     */
    public $widgetparams;

    /**
     * Unpack TicketsalesFlowConfig from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\TicketsalesFlowConfig
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new TicketsalesFlowConfig(array(
            "from" => isset($obj->from) ? Json::unpackTimestamp($obj->from) : null,
            "until" => isset($obj->until) ? Json::unpackTimestamp($obj->until) : null,
            "widget" => isset($obj->widget) ? $obj->widget : null,
            "widgetparams" => isset($obj->widgetparams) ? $obj->widgetparams : null,
        ));
    }

    /**
     * Serialize TicketsalesFlowConfig to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->from)) {
            $result["from"] = Json::packTimestamp($this->from);
        }
        if (!is_null($this->until)) {
            $result["until"] = Json::packTimestamp($this->until);
        }
        if (!is_null($this->widget)) {
            $result["widget"] = strval($this->widget);
        }
        if (!is_null($this->widgetparams)) {
            $result["widgetparams"] = $this->widgetparams;
        }

        return $result;
    }
}
