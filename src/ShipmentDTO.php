<?php

namespace SentrumDTO;

use Exception;
use SentrumDTO\Enums\Status;

class ShipmentDTO implements DTOInterface
{
	public int $id = 0;

	public string $xmlId = '';

    public int $orderId = 0;

    public string $orderXmlId = '';

    public string $orderAccountNumber = '';

    /**
     * Shipment insert date, timestamp
     * @var int $dateInsert
     */
    public int $dateInsert = 0;

    /**
     * Shipment shipped date, timestamp
     * @var int $dateShipped
     */
    public int $dateShipped = 0;

	public string $status = '';

    /**
     * Is shipment already shipped
     * @var bool $shipped
     */
	public bool $shipped = false;

    /**
     * Is it system shipment
     * @var bool $system
     */
	public bool $system = true;

	public int $weightGram = 0;

	public float $deliveryPrice = 0.0;

	public string $carrier = '';

	public string $invoice = '';

	public float $invoiceAmount = 0.0;

    public int $deliveryDocumentDate = 0;

	public string $comment = '';

	public string $library = '';

	public string $userEmail = '';

	public string $knigamirId = '';

    /**
     * @var ShipmentItemDTO[]
     */
    public array $items = [];

    /**
     * @param array $fields
     * @return ShipmentDTO
     * @throws Exception
     */
    public static function fromArray(array $fields): ShipmentDTO
    {
        $shipmentDTO = new self();

        if (empty($fields['xml_id'])) {
            throw new Exception('Shipment xml id not defined');
        }

        $shipmentDTO->id = isset($fields['id']) ? intval($fields['id']) : 0;
        $shipmentDTO->xmlId = isset($fields['xml_id']) ? (string)$fields['xml_id'] : '';
        $shipmentDTO->orderId = isset($fields['order_id']) ? intval($fields['order_id']) : 0;
        $shipmentDTO->orderXmlId = isset($fields['order_xml_id']) ? (string)$fields['order_xml_id'] : '';
        $shipmentDTO->orderAccountNumber = isset($fields['order_account_number']) ? (string)$fields['order_account_number'] : '';
        $shipmentDTO->dateInsert = isset($fields['date_insert']) ? intval($fields['date_insert']) : 0;
        $shipmentDTO->dateShipped = isset($fields['date_shipped']) ? intval($fields['date_shipped']) : 0;
        $shipmentDTO->status = Status::getStatus((string)$fields['status'] ?: '');
        $shipmentDTO->shipped = isset($fields['shipped']) ? boolval($fields['shipped']) : false;
        $shipmentDTO->system = isset($fields['system']) ? boolval($fields['system']) : false;
        $shipmentDTO->weightGram = isset($fields['weight_gram']) ? intval($fields['weight_gram']) : 0;
        $shipmentDTO->deliveryPrice = isset($fields['delivery_price']) ? floatval($fields['delivery_price']) : 0.0;
        $shipmentDTO->carrier = isset($fields['carrier']) ? (string)$fields['carrier'] : '';
        $shipmentDTO->invoice = isset($fields['invoice']) ? (string)$fields['invoice'] : '';
        $shipmentDTO->invoiceAmount = isset($fields['invoice_amount']) ? floatval($fields['invoice_amount']) : 0.0;
        $shipmentDTO->deliveryDocumentDate = isset($fields['delivery_document_date']) ? intval($fields['delivery_document_date']) : 0;
        $shipmentDTO->comment = isset($fields['comment']) ? (string)$fields['comment'] : '';
        $shipmentDTO->library = isset($fields['library']) ? (string)$fields['library'] : '';
        $shipmentDTO->userEmail = isset($fields['user_email']) ? (string)$fields['user_email'] : '';
        $shipmentDTO->knigamirId = isset($fields['knigamir_id']) ? (string)$fields['knigamir_id'] : '';

        if (
            !empty($fields['items'])
            && is_array($fields['items'])
        ) {
            foreach ($fields['items'] as $item) {
                $shipmentDTO->items[] = ShipmentItemDTO::fromArray($item);
            }
        }

        return $shipmentDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $response = [
            'id' => intval($this->id),
            'xml_id' => (string)$this->xmlId,
            'order_id' => intval($this->orderId),
            'order_xml_id' => (string)$this->orderXmlId,
            'order_account_number' => (string)$this->orderAccountNumber,
            'date_insert' => intval($this->dateInsert),
            'date_shipped' => intval($this->dateShipped),
            'status' => Status::getStatus((string)$this->status),
            'shipped' => boolval($this->shipped),
            'system' => boolval($this->system),
            'weight_gram' => intval($this->weightGram),
            'delivery_price' => floatval($this->deliveryPrice),
            'carrier' => (string)$this->carrier,
            'invoice' => (string)$this->invoice,
            'invoice_amount' => floatval($this->invoiceAmount),
            'delivery_document_date' => intval($this->deliveryDocumentDate),
            'comment' => (string)$this->comment,
            'library' => (string)$this->library,
            'user_email' => (string)$this->userEmail,
            'knigamir_id' => (string)$this->knigamirId,
            'items' => []
        ];

        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                $response['items'][] = $item->toArray();
            }
        }

        return $response;
    }
}
