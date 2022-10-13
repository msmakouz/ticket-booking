<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: api/cinema/v1/message.proto

namespace Spiral\Shared\Services\Cinema\v1\DTO;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>api.cinema.v1.dto.CheckSeatsResponse</code>
 */
class CheckSeatsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Seat reserved_seats = 1;</code>
     */
    private $reserved_seats;
    /**
     * Generated from protobuf field <code>string error_message = 2;</code>
     */
    protected $error_message = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Spiral\Shared\Services\Cinema\v1\DTO\Seat[]|\Google\Protobuf\Internal\RepeatedField $reserved_seats
     *     @type string $error_message
     * }
     */
    public function __construct($data = NULL) {
        \Spiral\Shared\Services\Cinema\v1\GPBMetadata\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Seat reserved_seats = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getReservedSeats()
    {
        return $this->reserved_seats;
    }

    /**
     * Generated from protobuf field <code>repeated .api.cinema.v1.dto.Seat reserved_seats = 1;</code>
     * @param \Spiral\Shared\Services\Cinema\v1\DTO\Seat[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setReservedSeats($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Spiral\Shared\Services\Cinema\v1\DTO\Seat::class);
        $this->reserved_seats = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string error_message = 2;</code>
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * Generated from protobuf field <code>string error_message = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setErrorMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->error_message = $var;

        return $this;
    }

}

