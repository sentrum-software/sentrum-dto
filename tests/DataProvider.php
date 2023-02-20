<?php

namespace SentrumDTO;

class DataProvider
{
    public static function getProduct(): array
    {
        return self::getJson('product.json');
    }

    public static function getBasketItem(): array
    {
        $basketItem = self::getJson('basket_item.json');
        $basketItem['product'] = self::getProduct();
        return $basketItem;
    }

    public static function getShipmentItem(): array
    {
        $shipmentItem = self::getJson('shipment_item.json');
        $shipmentItem['basket_item'] = self::getBasketItem();
        return $shipmentItem;
    }

    public static function getShipment(bool $withOrder = true): array
    {
        $shipment = self::getJson('shipment.json');
        $shipment['items'][0] = self::getShipmentItem();
        $shipment['items'][1] = self::getShipmentItem();

        if ($withOrder) {
            $shipment['order'] = self::getJson('order.json');
        }

        return $shipment;
    }

    public static function getOrder(): array
    {
        $order = self::getJson('order.json');
        $order['shipments'][0] = self::getShipment(false);
        $order['shipments'][1] = self::getShipment(false);
        $order['basket'][0] = self::getBasketItem();
        $order['basket'][1] = self::getBasketItem();

        return $order;
    }

    public static function getEvent(): array
    {
        return self::getJson('event.json');
    }

    public static function getEventResult(): array
    {
        return self::getJson('event_result.json');
    }

    private static function getJson(string $name): array
    {
        $path = implode('/', [__DIR__, 'stubs', $name]);
        return json_decode(file_get_contents($path), true);
    }
}