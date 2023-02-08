<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\ProductDTO
 */
class ProductDTOTest extends TestCase
{
    public function testTransformation(): void
    {
        $loadedArray = DataProvider::getProduct();

        $productDTO = ProductDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $productDTO->toArray());
    }
}
