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
 * Report Options
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ReportOptions).
 */
class ReportOptions implements \jsonSerializable
{
    /**
     * Create a new ReportOptions
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The pagesize for the report when exported as Excel.
     *
     * @var int
     */
    public $excelpagewidth;

    /**
     * Excel-specific option for scaling the width
     *
     * @var float
     */
    public $excelscaling;

    /**
     * The pagesize for the report: A4 landscape, Letter landscape, ...
     *
     * @var string
     */
    public $pdfpagesize;

    /**
     * Indicates if a system font should be used.
     *
     * @var bool
     */
    public $usesystemfont;

    /**
     * Unpack ReportOptions from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ReportOptions
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ReportOptions(array(
            "excelpagewidth" => isset($obj->excelpagewidth) ? $obj->excelpagewidth : null,
            "excelscaling" => isset($obj->excelscaling) ? $obj->excelscaling : null,
            "pdfpagesize" => isset($obj->pdfpagesize) ? $obj->pdfpagesize : null,
            "usesystemfont" => isset($obj->usesystemfont) ? $obj->usesystemfont : null,
        ));
    }

    /**
     * Serialize ReportOptions to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->excelpagewidth)) {
            $result["excelpagewidth"] = intval($this->excelpagewidth);
        }
        if (!is_null($this->excelscaling)) {
            $result["excelscaling"] = floatval($this->excelscaling);
        }
        if (!is_null($this->pdfpagesize)) {
            $result["pdfpagesize"] = strval($this->pdfpagesize);
        }
        if (!is_null($this->usesystemfont)) {
            $result["usesystemfont"] = (bool)$this->usesystemfont;
        }

        return $result;
    }
}
