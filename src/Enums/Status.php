<?php

namespace SentrumDTO\Enums;

use Exception;

class Status
{
    public const NEW = 'new';
    public const IN_PROCESS = 'in_process';
    public const PROFORMA_SUBMITTED = 'proforma_submitted';
    public const AWAITING_FOR_VENDOR = 'awaiting_for_vendor';
    public const SUBSCRIPTION = 'subscription';
    public const VENDOR_PARTLY_FULFILLED = 'vendor_partly_fulfilled';
    public const SENT = 'sent';
    public const COMPLETED = 'completed';
    public const CANCELED = 'canceled';
    public const SHIPMENT_WAITING = 'shipment_waiting';
    public const SHIPMENT_PICKING = 'shipment_picking';
    public const SHIPMENT_READY = 'shipment_ready';
    public const SHIPMENT_HOLD = 'shipment_hold';
    public const SHIPMENT_SENT = 'shipment_sent';
    public const SHIPMENT_CANCELED = 'shipment_canceled';

    /**
     * @param string $status
     * @return string
     * @throws Exception
     */
    public static function getStatus(string $status): string
    {
        if (in_array($status, [
            self::NEW,
            self::IN_PROCESS,
            self::PROFORMA_SUBMITTED,
            self::AWAITING_FOR_VENDOR,
            self::SUBSCRIPTION,
            self::VENDOR_PARTLY_FULFILLED,
            self::SENT,
            self::COMPLETED,
            self::CANCELED,
            self::SHIPMENT_WAITING,
            self::SHIPMENT_PICKING,
            self::SHIPMENT_READY,
            self::SHIPMENT_HOLD,
            self::SHIPMENT_SENT,
            self::SHIPMENT_CANCELED,
        ])) {
            return $status;
        }

        throw new Exception('Unknown status "' . $status . '"');
    }
}