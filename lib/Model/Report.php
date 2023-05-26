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
 * A single report.
 *
 * More info: see the get operation (api/settings/system/reports/get) and the
 * reports endpoint (api/settings/system/reports).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Report).
 */
class Report implements \jsonSerializable
{
    /**
     * Create a new Report
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new report.
     *
     * **Note:** Ignored when updating an existing report.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the report
     *
     * @var string
     */
    public $name;

    /**
     * The actual report definition, see reports
     * (tickets/reporting_and_followup/reporting/) for more information.
     *
     * **Note:** Not set when retrieving a list of reports.
     *
     * @var object[][][]
     */
    public $content;

    /**
     * Reports can be generated as pdf or excel file. This field defines the default
     * format. Possible values are 'pdf' or 'excel'
     *
     * @var string
     */
    public $defaultformat;

    /**
     * Description of the report
     *
     * @var string
     */
    public $description;

    /**
     * List of email recipients that should receive the report in bcc, separated by ;
     *
     * @var string
     */
    public $emailbcc;

    /**
     * List of email recipients that should receive the report in cc, separated by ;
     *
     * @var string
     */
    public $emailcc;

    /**
     * List of email recipients that should receive the report, separated by ;
     *
     * @var string
     */
    public $emailrecipients;

    /**
     * Indicates if this report is scheduled to be sent by mail at a certain interval
     *
     * @var bool
     */
    public $emailschedule;

    /**
     * Day of the month the report will be sent.
     *
     * @var int
     */
    public $emailscheduledayofmonth;

    /**
     * Day of the week the report will be sent. 1 = monday -> 7 = sunday
     *
     * @var int
     */
    public $emailscheduledayofweek;

    /**
     * Hour of the day the report will be sent
     *
     * @var int
     */
    public $emailschedulehourofday;

    /**
     * Report will only be sent if the given query returns at least one result.
     *
     * @var string
     */
    public $emailschedulequery;

    /**
     * Key-value array of options. Can contain: pdfpagesize, excelpagewidth,
     * excelscaling, usesystemfont
     *
     * **Note:** Not set when retrieving a list of reports.
     *
     * @var \Ticketmatic\Model\ReportOptions
     */
    public $options;

    /**
     * The report type defines the UI and parameters that are used when generating the
     * report
     *
     * @var int
     */
    public $reporttypeid;

    /**
     * A list of subtitles for the report
     *
     * **Note:** Not set when retrieving a list of reports.
     *
     * @var string[]
     */
    public $subtitles;

    /**
     * A map of language codes to gettext .po files
     * (http://en.wikipedia.org/wiki/Gettext).
     *
     * **Note:** Not set when retrieving a list of reports.
     *
     * @var string[]
     */
    public $translations;

    /**
     * Indicates where the report is being used. Possible values: 17001 (Sales),
     * 17002 (External sales), 17003 (Hidden)
     *
     * @var int
     */
    public $usagetypeid;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new report.
     *
     * **Note:** Ignored when updating an existing report.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new report.
     *
     * **Note:** Ignored when updating an existing report.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack Report from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Report
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Report(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "content" => isset($obj->content) ? $obj->content : null,
            "defaultformat" => isset($obj->defaultformat) ? $obj->defaultformat : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "emailbcc" => isset($obj->emailbcc) ? $obj->emailbcc : null,
            "emailcc" => isset($obj->emailcc) ? $obj->emailcc : null,
            "emailrecipients" => isset($obj->emailrecipients) ? $obj->emailrecipients : null,
            "emailschedule" => isset($obj->emailschedule) ? $obj->emailschedule : null,
            "emailscheduledayofmonth" => isset($obj->emailscheduledayofmonth) ? $obj->emailscheduledayofmonth : null,
            "emailscheduledayofweek" => isset($obj->emailscheduledayofweek) ? $obj->emailscheduledayofweek : null,
            "emailschedulehourofday" => isset($obj->emailschedulehourofday) ? $obj->emailschedulehourofday : null,
            "emailschedulequery" => isset($obj->emailschedulequery) ? $obj->emailschedulequery : null,
            "options" => isset($obj->options) ? ReportOptions::fromJson($obj->options) : null,
            "reporttypeid" => isset($obj->reporttypeid) ? $obj->reporttypeid : null,
            "subtitles" => isset($obj->subtitles) ? $obj->subtitles : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "usagetypeid" => isset($obj->usagetypeid) ? $obj->usagetypeid : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize Report to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->content)) {
            $result["content"] = $this->content;
        }
        if (!is_null($this->defaultformat)) {
            $result["defaultformat"] = strval($this->defaultformat);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->emailbcc)) {
            $result["emailbcc"] = strval($this->emailbcc);
        }
        if (!is_null($this->emailcc)) {
            $result["emailcc"] = strval($this->emailcc);
        }
        if (!is_null($this->emailrecipients)) {
            $result["emailrecipients"] = strval($this->emailrecipients);
        }
        if (!is_null($this->emailschedule)) {
            $result["emailschedule"] = (bool)$this->emailschedule;
        }
        if (!is_null($this->emailscheduledayofmonth)) {
            $result["emailscheduledayofmonth"] = intval($this->emailscheduledayofmonth);
        }
        if (!is_null($this->emailscheduledayofweek)) {
            $result["emailscheduledayofweek"] = intval($this->emailscheduledayofweek);
        }
        if (!is_null($this->emailschedulehourofday)) {
            $result["emailschedulehourofday"] = intval($this->emailschedulehourofday);
        }
        if (!is_null($this->emailschedulequery)) {
            $result["emailschedulequery"] = strval($this->emailschedulequery);
        }
        if (!is_null($this->options)) {
            $result["options"] = $this->options;
        }
        if (!is_null($this->reporttypeid)) {
            $result["reporttypeid"] = intval($this->reporttypeid);
        }
        if (!is_null($this->subtitles)) {
            $result["subtitles"] = $this->subtitles;
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
        }
        if (!is_null($this->usagetypeid)) {
            $result["usagetypeid"] = intval($this->usagetypeid);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
