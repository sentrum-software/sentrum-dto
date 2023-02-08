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
        $loadedArray = DataProvider::getOrder();

        $shipmentDTO = OrderDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $shipmentDTO->toArray());
    }
}
