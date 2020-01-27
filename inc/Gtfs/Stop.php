<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/gtfs.proto

namespace Gtfs;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>gtfs.Stop</code>
 */
class Stop extends \Google\Protobuf\Internal\Message
{
    /**
     * The stop_id field contains an ID that uniquely identifies a stop or station.
     * Multiple routes may use the same stop. stop_id is dataset unique.
     *
     * Generated from protobuf field <code>string stop_id = 1;</code>
     */
    protected $stop_id = '';
    /**
     * The stop_code field contains short text or a number that uniquely identifies the stop for passengers.
     *
     * Generated from protobuf field <code>string stop_code = 2;</code>
     */
    protected $stop_code = '';
    /**
     * The stop_name field contains the name of a stop or station.
     *
     * Generated from protobuf field <code>string stop_name = 3;</code>
     */
    protected $stop_name = '';
    /**
     * The stop_desc field contains a description of a stop.
     *
     * Generated from protobuf field <code>string stop_desc = 4;</code>
     */
    protected $stop_desc = '';
    /**
     * Degrees North, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float latitude = 5;</code>
     */
    protected $latitude = 0.0;
    /**
     * Degrees East, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float longitude = 6;</code>
     */
    protected $longitude = 0.0;
    /**
     * Generated from protobuf field <code>string zone_id = 7;</code>
     */
    protected $zone_id = '';
    /**
     * Generated from protobuf field <code>string stop_url = 8;</code>
     */
    protected $stop_url = '';
    /**
     * Generated from protobuf field <code>.gtfs.Stop.LocationType location_type = 9;</code>
     */
    protected $location_type = 0;
    /**
     * Generated from protobuf field <code>string parent_station = 10;</code>
     */
    protected $parent_station = '';
    /**
     * Generated from protobuf field <code>string agency_timezone = 11;</code>
     */
    protected $agency_timezone = '';
    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     *
     * Generated from protobuf field <code>.gtfs.Stop.WheelchairBoarding wheelchair_boarding = 12;</code>
     */
    protected $wheelchair_boarding = 0;
    /**
     * The extensions namespace allows 3rd-party developers to extend the
     * GTFS specification in order to add and evaluate new features and
     * modifications to the spec.
     *
     * Generated from protobuf field <code>.google.protobuf.Any extension = 2000;</code>
     */
    protected $extension = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $stop_id
     *           The stop_id field contains an ID that uniquely identifies a stop or station.
     *           Multiple routes may use the same stop. stop_id is dataset unique.
     *     @type string $stop_code
     *           The stop_code field contains short text or a number that uniquely identifies the stop for passengers.
     *     @type string $stop_name
     *           The stop_name field contains the name of a stop or station.
     *     @type string $stop_desc
     *           The stop_desc field contains a description of a stop.
     *     @type float $latitude
     *           Degrees North, in the WGS-84 coordinate system.
     *     @type float $longitude
     *           Degrees East, in the WGS-84 coordinate system.
     *     @type string $zone_id
     *     @type string $stop_url
     *     @type int $location_type
     *     @type string $parent_station
     *     @type string $agency_timezone
     *     @type int $wheelchair_boarding
     *           The exact status of the vehicle with respect to the current stop.
     *           Ignored if current_stop_sequence is missing.
     *     @type \Google\Protobuf\Any $extension
     *           The extensions namespace allows 3rd-party developers to extend the
     *           GTFS specification in order to add and evaluate new features and
     *           modifications to the spec.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Gtfs::initOnce();
        parent::__construct($data);
    }

    /**
     * The stop_id field contains an ID that uniquely identifies a stop or station.
     * Multiple routes may use the same stop. stop_id is dataset unique.
     *
     * Generated from protobuf field <code>string stop_id = 1;</code>
     * @return string
     */
    public function getStopId()
    {
        return $this->stop_id;
    }

    /**
     * The stop_id field contains an ID that uniquely identifies a stop or station.
     * Multiple routes may use the same stop. stop_id is dataset unique.
     *
     * Generated from protobuf field <code>string stop_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setStopId($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_id = $var;

        return $this;
    }

    /**
     * The stop_code field contains short text or a number that uniquely identifies the stop for passengers.
     *
     * Generated from protobuf field <code>string stop_code = 2;</code>
     * @return string
     */
    public function getStopCode()
    {
        return $this->stop_code;
    }

    /**
     * The stop_code field contains short text or a number that uniquely identifies the stop for passengers.
     *
     * Generated from protobuf field <code>string stop_code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setStopCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_code = $var;

        return $this;
    }

    /**
     * The stop_name field contains the name of a stop or station.
     *
     * Generated from protobuf field <code>string stop_name = 3;</code>
     * @return string
     */
    public function getStopName()
    {
        return $this->stop_name;
    }

    /**
     * The stop_name field contains the name of a stop or station.
     *
     * Generated from protobuf field <code>string stop_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setStopName($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_name = $var;

        return $this;
    }

    /**
     * The stop_desc field contains a description of a stop.
     *
     * Generated from protobuf field <code>string stop_desc = 4;</code>
     * @return string
     */
    public function getStopDesc()
    {
        return $this->stop_desc;
    }

    /**
     * The stop_desc field contains a description of a stop.
     *
     * Generated from protobuf field <code>string stop_desc = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setStopDesc($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_desc = $var;

        return $this;
    }

    /**
     * Degrees North, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float latitude = 5;</code>
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Degrees North, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float latitude = 5;</code>
     * @param float $var
     * @return $this
     */
    public function setLatitude($var)
    {
        GPBUtil::checkFloat($var);
        $this->latitude = $var;

        return $this;
    }

    /**
     * Degrees East, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float longitude = 6;</code>
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Degrees East, in the WGS-84 coordinate system.
     *
     * Generated from protobuf field <code>float longitude = 6;</code>
     * @param float $var
     * @return $this
     */
    public function setLongitude($var)
    {
        GPBUtil::checkFloat($var);
        $this->longitude = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string zone_id = 7;</code>
     * @return string
     */
    public function getZoneId()
    {
        return $this->zone_id;
    }

    /**
     * Generated from protobuf field <code>string zone_id = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setZoneId($var)
    {
        GPBUtil::checkString($var, True);
        $this->zone_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string stop_url = 8;</code>
     * @return string
     */
    public function getStopUrl()
    {
        return $this->stop_url;
    }

    /**
     * Generated from protobuf field <code>string stop_url = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setStopUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_url = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.gtfs.Stop.LocationType location_type = 9;</code>
     * @return int
     */
    public function getLocationType()
    {
        return $this->location_type;
    }

    /**
     * Generated from protobuf field <code>.gtfs.Stop.LocationType location_type = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setLocationType($var)
    {
        GPBUtil::checkEnum($var, \Gtfs\Stop_LocationType::class);
        $this->location_type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string parent_station = 10;</code>
     * @return string
     */
    public function getParentStation()
    {
        return $this->parent_station;
    }

    /**
     * Generated from protobuf field <code>string parent_station = 10;</code>
     * @param string $var
     * @return $this
     */
    public function setParentStation($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent_station = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string agency_timezone = 11;</code>
     * @return string
     */
    public function getAgencyTimezone()
    {
        return $this->agency_timezone;
    }

    /**
     * Generated from protobuf field <code>string agency_timezone = 11;</code>
     * @param string $var
     * @return $this
     */
    public function setAgencyTimezone($var)
    {
        GPBUtil::checkString($var, True);
        $this->agency_timezone = $var;

        return $this;
    }

    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     *
     * Generated from protobuf field <code>.gtfs.Stop.WheelchairBoarding wheelchair_boarding = 12;</code>
     * @return int
     */
    public function getWheelchairBoarding()
    {
        return $this->wheelchair_boarding;
    }

    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     *
     * Generated from protobuf field <code>.gtfs.Stop.WheelchairBoarding wheelchair_boarding = 12;</code>
     * @param int $var
     * @return $this
     */
    public function setWheelchairBoarding($var)
    {
        GPBUtil::checkEnum($var, \Gtfs\Stop_WheelchairBoarding::class);
        $this->wheelchair_boarding = $var;

        return $this;
    }

    /**
     * The extensions namespace allows 3rd-party developers to extend the
     * GTFS specification in order to add and evaluate new features and
     * modifications to the spec.
     *
     * Generated from protobuf field <code>.google.protobuf.Any extension = 2000;</code>
     * @return \Google\Protobuf\Any
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * The extensions namespace allows 3rd-party developers to extend the
     * GTFS specification in order to add and evaluate new features and
     * modifications to the spec.
     *
     * Generated from protobuf field <code>.google.protobuf.Any extension = 2000;</code>
     * @param \Google\Protobuf\Any $var
     * @return $this
     */
    public function setExtension($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Any::class);
        $this->extension = $var;

        return $this;
    }

}

