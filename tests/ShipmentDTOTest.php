<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\ShipmentDTO
 */
class ShipmentDTOTest extends TestCase
{
    public function testTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/shipment.json'), true);

        $loadedArray['items'][0] = json_decode(file_get_contents(__DIR__ . '/stubs/shipment_item.json'), true);
        $loadedArray['items'][0]['basket_item'] = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['items'][0]['basket_item']['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);
        $loadedArray['items'][1] = $loadedArray['items'][0];

        $shipmentDTO = ShipmentDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $shipmentDTO->toArray());
    }
}
