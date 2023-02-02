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
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);

        $productDTO = ProductDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $productDTO->toArray());
    }
}
