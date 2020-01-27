<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/gtfs.proto

namespace Gtfs;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>gtfs.FareRule</code>
 */
class FareRule extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string fare_id = 1;</code>
     */
    protected $fare_id = '';
    /**
     * Generated from protobuf field <code>string route_id = 2;</code>
     */
    protected $route_id = '';
    /**
     * Generated from protobuf field <code>string origin_id = 3;</code>
     */
    protected $origin_id = '';
    /**
     * Generated from protobuf field <code>string destination_id = 4;</code>
     */
    protected $destination_id = '';
    /**
     * Generated from protobuf field <code>string contains_id = 5;</code>
     */
    protected $contains_id = '';
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
     *     @type string $fare_id
     *     @type string $route_id
     *     @type string $origin_id
     *     @type string $destination_id
     *     @type string $contains_id
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
     * Generated from protobuf field <code>string fare_id = 1;</code>
     * @return string
     */
    public function getFareId()
    {
        return $this->fare_id;
    }

    /**
     * Generated from protobuf field <code>string fare_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFareId($var)
    {
        GPBUtil::checkString($var, True);
        $this->fare_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string route_id = 2;</code>
     * @return string
     */
    public function getRouteId()
    {
        return $this->route_id;
    }

    /**
     * Generated from protobuf field <code>string route_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRouteId($var)
    {
        GPBUtil::checkString($var, True);
        $this->route_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string origin_id = 3;</code>
     * @return string
     */
    public function getOriginId()
    {
        return $this->origin_id;
    }

    /**
     * Generated from protobuf field <code>string origin_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setOriginId($var)
    {
        GPBUtil::checkString($var, True);
        $this->origin_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string destination_id = 4;</code>
     * @return string
     */
    public function getDestinationId()
    {
        return $this->destination_id;
    }

    /**
     * Generated from protobuf field <code>string destination_id = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setDestinationId($var)
    {
        GPBUtil::checkString($var, True);
        $this->destination_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string contains_id = 5;</code>
     * @return string
     */
    public function getContainsId()
    {
        return $this->contains_id;
    }

    /**
     * Generated from protobuf field <code>string contains_id = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setContainsId($var)
    {
        GPBUtil::checkString($var, True);
        $this->contains_id = $var;

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
