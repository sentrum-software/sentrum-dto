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
        $loadedArray = DataProvider::getShipment();

        $shipmentDTO = ShipmentDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $shipmentDTO->toArray());
    }
}
