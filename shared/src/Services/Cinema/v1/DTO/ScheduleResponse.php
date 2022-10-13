<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: api/cinema/v1/message.proto

namespace Spiral\Shared\Services\Cinema\v1\DTO;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>api.cinema.v1.dto.ScheduleResponse</code>
 */
class ScheduleResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Screening screenings = 1;</code>
     */
    private $screenings;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Spiral\Shared\Services\Cinema\v1\DTO\Screening[]|\Google\Protobuf\Internal\RepeatedField $screenings
     * }
     */
    public function __construct($data = NULL) {
        \Spiral\Shared\Services\Cinema\v1\GPBMetadata\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Screening screenings = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getScreenings()
    {
        return $this->screenings;
    }

    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Screening screenings = 1;</code>
     * @param \Spiral\Shared\Services\Cinema\v1\DTO\Screening[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setScreenings($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Spiral\Shared\Services\Cinema\v1\DTO\Screening::class);
        $this->screenings = $arr;

        return $this;
    }

}

