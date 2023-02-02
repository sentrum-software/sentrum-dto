<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\ShipmentItemDTO
 */
class ShipmentItemDTOTest extends TestCase
{
    public function testSuccessTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/shipment_item.json'), true);
        $loadedArray['basket_item'] = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['basket_item']['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);

        $shipmentItemDTO = ShipmentItemDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $shipmentItemDTO->toArray());
    }

    public function testBadTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/shipment_item.json'), true);

        $this->expectExceptionMessage('Basket item can\'t be empty');

        ShipmentItemDTO::fromArray($loadedArray);
    }
}
