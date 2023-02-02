<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\OrderDTO
 */
class OrderDTOTest extends TestCase
{
    public function testTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/order.json'), true);

        $loadedArray['shipments'][0] = json_decode(file_get_contents(__DIR__ . '/stubs/shipment.json'), true);
        $loadedArray['shipments'][0]['items'][0] = json_decode(file_get_contents(__DIR__ . '/stubs/shipment_item.json'), true);
        $loadedArray['shipments'][0]['items'][0]['basket_item'] = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['shipments'][0]['items'][0]['basket_item']['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);
        $loadedArray['shipments'][0]['items'][1] = json_decode(file_get_contents(__DIR__ . '/stubs/shipment_item.json'), true);
        $loadedArray['shipments'][0]['items'][1]['basket_item'] = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['shipments'][0]['items'][1]['basket_item']['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);
        $loadedArray['shipments'][1] = $loadedArray['shipments'][0];

        $loadedArray['basket'][0] = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['basket'][0]['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);
        $loadedArray['basket'][1] = $loadedArray['basket'][0];

        $shipmentDTO = OrderDTO::fromArray($loadedArray);


        $this->assertEquals($loadedArray, $shipmentDTO->toArray());
    }
}
