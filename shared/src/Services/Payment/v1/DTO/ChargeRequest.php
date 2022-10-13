<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: api/payment/v1/message.proto

namespace Spiral\Shared\Services\Payment\v1\DTO;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>api.payment.v1.dto.ChargeRequest</code>
 */
class ChargeRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Payment payment = 1;</code>
     */
    protected $payment = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Spiral\Shared\Services\Payment\v1\DTO\Payment $payment
     * }
     */
    public function __construct($data = NULL) {
        \Spiral\Shared\Services\Payment\v1\GPBMetadata\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Payment payment = 1;</code>
     * @return \Spiral\Shared\Services\Payment\v1\DTO\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Payment payment = 1;</code>
     * @param \Spiral\Shared\Services\Payment\v1\DTO\Payment $var
     * @return $this
     */
    public function setPayment($var)
    {
        GPBUtil::checkMessage($var, \Spiral\Shared\Services\Payment\v1\DTO\Payment::class);
        $this->payment = $var;

        return $this;
    }

}

