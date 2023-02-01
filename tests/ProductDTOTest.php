<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;
use SentrumDTO\Enums\ProductCategory;
use SentrumDTO\Enums\ProductLanguage;
use SentrumDTO\Enums\ProductType;

class ProductDTOTest extends TestCase
{
    public function testTransformation(): void
    {
        $productDTO = new ProductDTO();

        $productDTO->id = 2;
        $productDTO->xmlId = 'product_xml';
        $productDTO->name = 'Some product';
        $productDTO->oclc = '12312312321';
        $productDTO->author = 'Unknown author';
        $productDTO->type = ProductType::BOOK_ADULT;
        $productDTO->language = ProductLanguage::UKRAINIAN;
        $productDTO->category = ProductCategory::NONFICTION;
        $productDTO->pricePurchasing = 9.2;
        $productDTO->priceBase = 27.6;
        $productDTO->weightGram = 600;

        $productArray = $productDTO->toArray();

        $loadedProductDTO = ProductDTO::fromArray($productArray);

        $this->assertEquals($productArray, $loadedProductDTO->toArray());
    }
}
