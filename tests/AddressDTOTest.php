<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\AddressDTO
 */
class AddressDTOTest extends TestCase
{
    public function testTransformation(): void
    {
        $loadedArray = DataProvider::getAddress();

        $addressDto = AddressDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $addressDto->toArray());
    }
}
