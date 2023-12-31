<?php

namespace SentrumDTO;

use SentrumDTO\Enums\Status;

class OrderDTO implements DTOInterface
{
	public int $id = 0;

	public string $xmlId = '';

    /**
     * Order account number. 10-33, 317-1, etc.
     * @var string $accountNumber
     */
	public string $accountNumber = '';

    /**
     * Order insert date, timestamp
     * @var int $dateInsert
     */
    public int $dateInsert = 0;

    /**
     * Date of the latest status change, timestamp
     * @var int $dateStatus
     */
    public int $dateStatus = 0;

	public ?Status $status = null;

	public int $userId = 0;

    public string $userEmail = '';

    public string $library = '';

    public string $userComment = '';

    /**
     * Is first order of current user
     * @var bool $firstOrder
     */
    public bool $firstOrder = false;

    public float $price = 0.0;

    public float $discount = 0.0;

	public string $purchased = '';

    /**
     * ID of order in Knigamir account
     * @var string $knigamirId
     */
	public string $knigamirId = '';

    /**
     * List of products in order
     * @var BasketItemDTO[]
     */
    public array $basket = [];

	/**
     * List of order shipments
	 * @var ShipmentDTO[]
	 */
	public array $shipments = [];

    public static function fromArray(array $fields): OrderDTO
    {
        $orderDTO = new self();

        $orderDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $orderDTO->xmlId = isset($fields['xml_id']) ? (string)$fields['xml_id'] : '';
        $orderDTO->accountNumber = isset($fields['account_number']) ? (string)$fields['account_number'] : '';
        $orderDTO->dateInsert = isset($fields['date_insert']) ? intval($fields['date_insert']) : 0;
        $orderDTO->dateStatus = isset($fields['date_status']) ? intval($fields['date_status']) : 0;
        $orderDTO->status = Status::tryFrom($fields['status'] ?: '');
        $orderDTO->userId = isset($fields['user_id']) ? intval($fields['user_id']) : 0;
        $orderDTO->userEmail = isset($fields['user_email']) ? (string)$fields['user_email'] : '';
        $orderDTO->library = isset($fields['library']) ? (string)$fields['library'] : '';
        $orderDTO->userComment = isset($fields['user_comment']) ? (string)$fields['user_comment'] : '';
        $orderDTO->firstOrder = isset($fields['first_order']) ? boolval($fields['first_order']) : false;
        $orderDTO->price = isset($fields['price']) ? floatval($fields['price']) : 0.0;
        $orderDTO->discount = isset($fields['discount']) ? floatval($fields['discount']) : 0.0;
        $orderDTO->purchased = isset($fields['purchased']) ? (string)$fields['purchased'] : '';
        $orderDTO->knigamirId = isset($fields['knigamir_id']) ? (string)$fields['knigamir_id'] : '';

        if (
            !empty($fields['basket'])
            && is_array($fields['basket'])
        ) {
            foreach ($fields['basket'] as $basketItem) {
                $orderDTO->basket[] = BasketItemDTO::fromArray($basketItem);
            }
        }

        if (
            !empty($fields['shipments'])
            && is_array($fields['shipments'])
        ) {
            foreach ($fields['shipments'] as $shipment) {
                $orderDTO->shipments[] = ShipmentDTO::fromArray($shipment);
            }
        }

        return $orderDTO;
    }

    public function toArray(): array
    {
        $order = [
            'id' => $this->id,
            'xml_id' => $this->xmlId,
            'account_number' => $this->accountNumber,
            'date_insert' => $this->dateInsert,
            'date_status' => $this->dateStatus,
            'status' => $this->status?->value,
            'user_id' => $this->userId,
            'user_email' => $this->userEmail,
            'library' => $this->library,
            'user_comment' => $this->userComment,
            'first_order' => $this->firstOrder,
            'price' => $this->price,
            'discount' => $this->discount,
            'purchased' => $this->purchased,
            'knigamir_id' => $this->knigamirId,
            'basket' => [],
            'shipments' => []
        ];

        if (!empty($this->basket)) {
            foreach ($this->basket as $basketItem) {
                $order['basket'][] = $basketItem->toArray();
            }
        }

        if (!empty($this->shipments)) {
            foreach ($this->shipments as $shipment) {
                $order['shipments'][] = $shipment->toArray();
            }
        }

        return $order;
    }
}
