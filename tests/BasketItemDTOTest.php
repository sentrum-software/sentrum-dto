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
        $loadedArray = DataProvider::getBasketItem();
        $basketItemDTO = BasketItemDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $basketItemDTO->toArray());
    }

    public function testBadTransformation(): void
    {
        $loadedArray = DataProvider::getBasketItem();
        $loadedArray['product'] = [];

        $this->expectExceptionMessage('Product can\'t be empty');

        BasketItemDTO::fromArray($loadedArray);
    }
}
