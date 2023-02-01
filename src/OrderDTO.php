<?php

namespace SentrumDTO;

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

    /**
     * Order status symbol (N, P, F, etc.)
     * @var string $status
     */
	public string $status = '';

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

    public static function fromArray(array $fields): DTOInterface
    {
        $orderDTO = new self();

        $orderDTO->id = intval($fields['id']);
        $orderDTO->xmlId = (string)$fields['xml_id'];
        $orderDTO->accountNumber = (string)$fields['account_number'];
        $orderDTO->dateInsert = intval($fields['date_insert']);
        $orderDTO->dateStatus = intval($fields['date_status']);
        $orderDTO->status = (string)$fields['status'];
        $orderDTO->userId = intval($fields['user_id']);
        $orderDTO->userEmail = (string)$fields['user_email'];
        $orderDTO->library = (string)$fields['library'];
        $orderDTO->userComment = (string)$fields['user_comment'];
        $orderDTO->firstOrder = boolval($fields['first_order']);
        $orderDTO->price = floatval($fields['price']);
        $orderDTO->discount = floatval($fields['discount']);
        $orderDTO->purchased = boolval($fields['purchased']);
        $orderDTO->knigamirId = (string)$fields['knigamir_id'];

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
            'id' => intval($this->id),
            'xml_id' => (string)$this->xmlId,
            'account_number' => (string)$this->accountNumber,
            'date_insert' => intval($this->dateInsert),
            'date_status' => intval($this->dateStatus),
            'status' => (string)$this->status,
            'user_id' => intval($this->userId),
            'user_email' => (string)$this->userEmail,
            'library' => (string)$this->library,
            'user_comment' => (string)$this->userComment,
            'first_order' => boolval($this->firstOrder),
            'price' => floatval($this->price),
            'discount' => floatval($this->discount),
            'purchased' => (string)$this->purchased,
            'knigamir_id' => (string)$this->knigamirId,
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
