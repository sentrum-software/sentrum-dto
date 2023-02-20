<?php

namespace SentrumDTO\Enums;

enum Status: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_process';
    case PROFORMA_SUBMITTED = 'proforma_submitted';
    case AWAITING_FOR_VENDOR = 'awaiting_for_vendor';
    case SUBSCRIPTION = 'subscription';
    case VENDOR_PARTLY_FULFILLED = 'vendor_partly_fulfilled';
    case SENT = 'sent';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
    case SHIPMENT_WAITING = 'shipment_waiting';
    case SHIPMENT_PICKING = 'shipment_picking';
    case SHIPMENT_READY = 'shipment_ready';
    case SHIPMENT_HOLD = 'shipment_hold';
    case SHIPMENT_SENT = 'shipment_sent';
    case SHIPMENT_CANCELED = 'shipment_canceled';
}