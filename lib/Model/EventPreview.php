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
 * Preview information for an event (api/types/Event).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventPreview).
 */
class EventPreview implements \jsonSerializable
{
    /**
     * Create a new EventPreview
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Link url
     *
     * @var string
     */
    public $linkurl;

    /**
     * Link to preview image
     *
     * @var string
     */
    public $previewimage;

    /**
     * Preview subtitle
     *
     * @var string
     */
    public $subtitle;

    /**
     * Preview title
     *
     * @var string
     */
    public $title;

    /**
     * Preview type. Currently supported values are: itunes (30001), youtube (30002),
     * soundcloud (30003)
     *
     * @var int
     */
    public $type;

    /**
     * Preview url
     *
     * @var string
     */
    public $url;

    /**
     * Unpack EventPreview from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventPreview
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventPreview(array(
            "linkurl" => isset($obj->linkurl) ? $obj->linkurl : null,
            "previewimage" => isset($obj->previewimage) ? $obj->previewimage : null,
            "subtitle" => isset($obj->subtitle) ? $obj->subtitle : null,
            "title" => isset($obj->title) ? $obj->title : null,
            "type" => isset($obj->type) ? $obj->type : null,
            "url" => isset($obj->url) ? $obj->url : null,
        ));
    }

    /**
     * Serialize EventPreview to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->linkurl)) {
            $result["linkurl"] = strval($this->linkurl);
        }
        if (!is_null($this->previewimage)) {
            $result["previewimage"] = strval($this->previewimage);
        }
        if (!is_null($this->subtitle)) {
            $result["subtitle"] = strval($this->subtitle);
        }
        if (!is_null($this->title)) {
            $result["title"] = strval($this->title);
        }
        if (!is_null($this->type)) {
            $result["type"] = intval($this->type);
        }
        if (!is_null($this->url)) {
            $result["url"] = strval($this->url);
        }

        return $result;
    }
}
