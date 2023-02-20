<?php

namespace SentrumDTO;

use Exception;
use SentrumDTO\Enums\Status;

class ShipmentDTO implements DTOInterface
{
	public int $id = 0;

	public string $xmlId = '';

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

	public ?Status $status = null;

    /**
     * Is shipment already shipped
     * @var bool $shipped
     */
	public bool $shipped = false;

	public int $weightGram = 0;

	public float $deliveryPrice = 0.0;

	public string $carrier = '';

	public string $invoice = '';

	public float $invoiceAmount = 0.0;

    public int $deliveryDocumentDate = 0;

	public string $comment = '';

    /**
     * @var ShipmentItemDTO[]
     */
    public array $items = [];

    public ?OrderDTO $order = null;

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
        $shipmentDTO->dateInsert = isset($fields['date_insert']) ? intval($fields['date_insert']) : 0;
        $shipmentDTO->dateShipped = isset($fields['date_shipped']) ? intval($fields['date_shipped']) : 0;
        $shipmentDTO->status = Status::tryFrom($fields['status'] ?: '');
        $shipmentDTO->shipped = isset($fields['shipped']) ? boolval($fields['shipped']) : false;
        $shipmentDTO->weightGram = isset($fields['weight_gram']) ? intval($fields['weight_gram']) : 0;
        $shipmentDTO->deliveryPrice = isset($fields['delivery_price']) ? floatval($fields['delivery_price']) : 0.0;
        $shipmentDTO->carrier = isset($fields['carrier']) ? (string)$fields['carrier'] : '';
        $shipmentDTO->invoice = isset($fields['invoice']) ? (string)$fields['invoice'] : '';
        $shipmentDTO->invoiceAmount = isset($fields['invoice_amount']) ? floatval($fields['invoice_amount']) : 0.0;
        $shipmentDTO->deliveryDocumentDate = isset($fields['delivery_document_date']) ? intval($fields['delivery_document_date']) : 0;
        $shipmentDTO->comment = isset($fields['comment']) ? (string)$fields['comment'] : '';

        if (
            !empty($fields['items'])
            && is_array($fields['items'])
        ) {
            foreach ($fields['items'] as $item) {
                $shipmentDTO->items[] = ShipmentItemDTO::fromArray($item);
            }
        }

        if (!empty($fields['order'])) {
            $shipmentDTO->order = OrderDTO::fromArray($fields['order']);
        }

        return $shipmentDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $response = [
            'id' => $this->id,
            'xml_id' => $this->xmlId,
            'date_insert' => $this->dateInsert,
            'date_shipped' => $this->dateShipped,
            'status' => $this->status?->value,
            'shipped' => $this->shipped,
            'weight_gram' => $this->weightGram,
            'delivery_price' => $this->deliveryPrice,
            'carrier' => $this->carrier,
            'invoice' => $this->invoice,
            'invoice_amount' => $this->invoiceAmount,
            'delivery_document_date' => $this->deliveryDocumentDate,
            'comment' => $this->comment,
            'items' => [],
            'order' => $this->order?->toArray()
        ];

        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                $response['items'][] = $item->toArray();
            }
        }

        return $response;
    }
}
