<?php

namespace SentrumDTO\Enums;

use Exception;

class EventType
{
    public const NEW_ORDER = 'new_order';
    public const UPDATE_ORDER = 'update_order';
    public const NEW_SHIPMENT = 'new_shipment';
    public const UPDATE_SHIPMENT = 'update_shipment';

    /**
     * @param string $type
     * @return string
     * @throws Exception
     */
    public static function getType(string $type): string
    {
        if (in_array($type, [
            self::NEW_ORDER,
            self::UPDATE_ORDER,
            self::NEW_SHIPMENT,
            self::UPDATE_SHIPMENT
        ])) {
            return $type;
        }

        throw new Exception('Undefined event type');
    }
}