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

    public static function fromArray(array $fields): OrderDTO
    {
        $orderDTO = new self();

        $orderDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $orderDTO->xmlId = isset($fields['xml_id']) ? (string)$fields['xml_id'] : '';
        $orderDTO->accountNumber = isset($fields['account_number']) ? (string)$fields['account_number'] : '';
        $orderDTO->dateInsert = isset($fields['date_insert']) ? intval($fields['date_insert']) : 0;
        $orderDTO->dateStatus = isset($fields['date_status']) ? intval($fields['date_status']) : 0;
        $orderDTO->status = isset($fields['status']) ? (string)$fields['status'] : '';
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
