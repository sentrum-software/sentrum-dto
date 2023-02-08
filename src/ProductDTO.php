<?php

namespace SentrumDTO;

use SentrumDTO\Enums\ProductType;
use SentrumDTO\Enums\ProductLanguage;
use SentrumDTO\Enums\ProductCategory;

class ProductDTO implements DTOInterface
{
	public int $id = 0;

	public string $xmlId = '';

	public string $name = '';

    public string $oclc = '';

    public string $author = '';

    /**
     * Product type.
     * Available types described in \SentrumDTO\Enums\ProductType
     * @var string $type
     */
	public string $type = '';

    /**
     * Product language.
     * Available languages described in \SentrumDTO\Enums\ProductLanguage
     * @var string $language
     */
	public string $language = '';

    /**
     * Product category (fiction/nonfiction/kids).
     * Available categories described in \SentrumDTO\Enums\ProductCategory
     * @var string $category
     */
    public string $category = '';

	public float $priceBase = 0.0;

	public float $pricePurchasing = 0.0;

    public int $weightGram = 0;

    /**
     * @param array $fields
     * @return ProductDTO
     */
    public static function fromArray(array $fields): ProductDTO
    {
        $productDTO = new self();

        $productDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $productDTO->xmlId = isset($fields['xml_id']) ? (string)$fields['xml_id'] : '';
        $productDTO->name = isset($fields['name']) ? (string)$fields['name'] : '';
        $productDTO->oclc = isset($fields['oclc']) ? (string)$fields['oclc'] : '';
        $productDTO->author = isset($fields['author']) ? (string)$fields['author'] : '';
        $productDTO->type = isset($fields['type']) ? ProductType::getType((string)$fields['type']) : '';
        $productDTO->language = isset($fields['language']) ? ProductLanguage::getLanguage((string)$fields['language']) : '';
        $productDTO->category = isset($fields['category']) ? ProductCategory::getCategory((string)$fields['category']) : '';
        $productDTO->pricePurchasing = isset($fields['price_purchasing']) ? floatval($fields['price_purchasing']) : 0.0;
        $productDTO->priceBase = isset($fields['price_base']) ? floatval($fields['price_base']) : 0.0;
        $productDTO->weightGram = isset($fields['weight_gram']) ? intval($fields['weight_gram']) : 0;

        return $productDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
	{
		return [
			'id' => intval($this->id),
            'xml_id' => (string)$this->xmlId,
            'name' => (string)$this->name,
            'oclc' => (string)$this->oclc,
            'author' => (string)$this->author,
            'type' => ProductType::getType((string)$this->type),
            'language' => ProductLanguage::getLanguage((string)$this->language),
            'category' => ProductCategory::getCategory((string)$this->category),
            'price_purchasing' => floatval($this->pricePurchasing),
            'price_base' => floatval($this->priceBase),
            'weight_gram' => intval($this->weightGram)
		];
	}
}
