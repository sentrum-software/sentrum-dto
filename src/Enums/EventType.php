<?php

namespace SentrumDTO\Enums;

enum EventType: string
{
    case NEW_ORDER = 'new_order';
    case UPDATE_ORDER = 'update_order';
    case NEW_SHIPMENT = 'new_shipment';
    case UPDATE_SHIPMENT = 'update_shipment';
    case NEW_LIBRARY = 'new_library';
    case UPDATE_LIBRARY = 'update_library';
}
