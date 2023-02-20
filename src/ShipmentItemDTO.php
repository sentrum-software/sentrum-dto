<?php

namespace SentrumDTO;

use Exception;

class ShipmentItemDTO implements DTOInterface
{
    public int $id = 0;

    public int $quantity = 0;

    public ?BasketItemDTO $basketItem = null;

    public static function fromArray(array $fields): ShipmentItemDTO
    {
        $shipmentItemDTO = new self();

        $shipmentItemDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $shipmentItemDTO->quantity = isset($fields['quantity']) ? intval($fields['quantity']) : 0;

        if (
            empty($fields['basket_item'])
            || !is_array($fields['basket_item'])
        ) {
            throw new Exception('Basket item can\'t be empty');
        }

        $shipmentItemDTO->basketItem = BasketItemDTO::fromArray($fields['basket_item']);

        return $shipmentItemDTO;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'basket_item' => $this->basketItem->toArray()
        ];
    }
}