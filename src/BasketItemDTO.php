<?php

namespace SentrumDTO;

use Exception;

class BasketItemDTO implements DTOInterface
{
    public int $id = 0;

    public int $quantity = 0;

    public float $price = 0.0;

    public float $discount = 0.0;

    public ?ProductDTO $product = null;

    /**
     * @param array $fields
     * @return BasketItemDTO
     * @throws Exception
     */
    public static function fromArray(array $fields): DTOInterface
    {
        $basketItemDTO = new self();

        $basketItemDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $basketItemDTO->quantity = isset($fields['quantity']) ? intval($fields['quantity']) : 0;
        $basketItemDTO->price = isset($fields['price']) ? floatval($fields['price']) : 0.0;
        $basketItemDTO->discount = isset($fields['discount']) ? floatval($fields['discount']) : 0.0;

        if (
            empty($fields['product'])
            || !is_array($fields['product'])
        ) {
            throw new Exception('Product can\'t be empty');
        }

        $basketItemDTO->product = ProductDTO::fromArray($fields['product']);

        return $basketItemDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => intval($this->id),
            'quantity' => intval($this->quantity),
            'price' => floatval($this->price),
            'discount' => floatval($this->discount),
            'product' => $this->product->toArray()
        ];
    }
}