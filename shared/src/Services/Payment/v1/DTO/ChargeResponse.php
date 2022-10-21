<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: api/payment/v1/message.proto

namespace Spiral\Shared\Services\Payment\v1\DTO;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>api.payment.v1.dto.ChargeResponse</code>
 */
class ChargeResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Receipt receipt = 1;</code>
     */
    protected $receipt = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Spiral\Shared\Services\Payment\v1\DTO\Receipt $receipt
     * }
     */
    public function __construct($data = NULL) {
        \Spiral\Shared\Services\Payment\v1\GPBMetadata\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Receipt receipt = 1;</code>
     * @return \Spiral\Shared\Services\Payment\v1\DTO\Receipt
     */
    public function getReceipt()
    {
        return $this->receipt;
    }

    /**
     * Generated from protobuf field <code>.api.payment.v1.dto.Receipt receipt = 1;</code>
     * @param \Spiral\Shared\Services\Payment\v1\DTO\Receipt $var
     * @return $this
     */
    public function setReceipt($var)
    {
        GPBUtil::checkMessage($var, \Spiral\Shared\Services\Payment\v1\DTO\Receipt::class);
        $this->receipt = $var;

        return $this;
    }

}

