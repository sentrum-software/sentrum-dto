<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\BasketItemDTO
 */
class BasketItemDTOTest extends TestCase
{
    public function testSuccessTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);
        $loadedArray['product'] = json_decode(file_get_contents(__DIR__ . '/stubs/product.json'), true);

        $basketItemDTO = BasketItemDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $basketItemDTO->toArray());
    }

    public function testBadTransformation(): void
    {
        $loadedArray = json_decode(file_get_contents(__DIR__ . '/stubs/basket_item.json'), true);

        $this->expectExceptionMessage('Product can\'t be empty');

        BasketItemDTO::fromArray($loadedArray);
    }
}
