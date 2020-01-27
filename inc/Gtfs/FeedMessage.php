<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/gtfs.proto

namespace Gtfs;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>gtfs.FeedMessage</code>
 */
class FeedMessage extends \Google\Protobuf\Internal\Message
{
    /**
     * Metadata about this feed and feed message.
     *
     * Generated from protobuf field <code>.gtfs.FeedHeader header = 1;</code>
     */
    protected $header = null;
    /**
     * Contents of the feed.
     *
     * Generated from protobuf field <code>repeated .gtfs.FeedEntity entity = 2;</code>
     */
    private $entity;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Gtfs\FeedHeader $header
     *           Metadata about this feed and feed message.
     *     @type \Gtfs\FeedEntity[]|\Google\Protobuf\Internal\RepeatedField $entity
     *           Contents of the feed.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Gtfs::initOnce();
        parent::__construct($data);
    }

    /**
     * Metadata about this feed and feed message.
     *
     * Generated from protobuf field <code>.gtfs.FeedHeader header = 1;</code>
     * @return \Gtfs\FeedHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Metadata about this feed and feed message.
     *
     * Generated from protobuf field <code>.gtfs.FeedHeader header = 1;</code>
     * @param \Gtfs\FeedHeader $var
     * @return $this
     */
    public function setHeader($var)
    {
        GPBUtil::checkMessage($var, \Gtfs\FeedHeader::class);
        $this->header = $var;

        return $this;
    }

    /**
     * Contents of the feed.
     *
     * Generated from protobuf field <code>repeated .gtfs.FeedEntity entity = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Contents of the feed.
     *
     * Generated from protobuf field <code>repeated .gtfs.FeedEntity entity = 2;</code>
     * @param \Gtfs\FeedEntity[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setEntity($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Gtfs\FeedEntity::class);
        $this->entity = $arr;

        return $this;
    }

}

