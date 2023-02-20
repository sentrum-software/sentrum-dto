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

	public ?ProductType $type = null;

	public ?ProductLanguage $language = null;

    public ?ProductCategory $category = null;

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
        $productDTO->type = ProductType::tryFrom($fields['type'] ?: '');
        $productDTO->language = ProductLanguage::tryFrom($fields['language'] ?: '');
        $productDTO->category = ProductCategory::tryFrom($fields['category'] ?: '');
        $productDTO->pricePurchasing = isset($fields['price_purchasing']) ? floatval($fields['price_purchasing']) : 0.0;
        $productDTO->priceBase = isset($fields['price_base']) ? floatval($fields['price_base']) : 0.0;
        $productDTO->weightGram = isset($fields['weight_gram']) ? intval($fields['weight_gram']) : 0;

        return $productDTO;
    }

    public function toArray(): array
	{
		return [
			'id' => $this->id,
            'xml_id' => $this->xmlId,
            'name' => $this->name,
            'oclc' => $this->oclc,
            'author' => $this->author,
            'type' => $this->type?->value,
            'language' => $this->language?->value,
            'category' => $this->category?->value,
            'price_purchasing' => $this->pricePurchasing,
            'price_base' => $this->priceBase,
            'weight_gram' => $this->weightGram
		];
	}
}
