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
        $loadedArray = DataProvider::getShipmentItem();

        $shipmentItemDTO = ShipmentItemDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $shipmentItemDTO->toArray());
    }

    public function testBadTransformation(): void
    {
        $loadedArray = DataProvider::getShipmentItem();
        $loadedArray['basket_item'] = '';

        $this->expectExceptionMessage('Basket item can\'t be empty');

        ShipmentItemDTO::fromArray($loadedArray);
    }
}
