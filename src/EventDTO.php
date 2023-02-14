<?php

namespace SentrumDTO;

use Exception;
use SentrumDTO\Enums\EventType;

class EventDTO implements DTOInterface
{
    /**
     * Event id
     * @var int $id
     */
    public int $id = 0;

    /**
     * Event type
     * @see \SentrumDTO\Enums\EventType
     * @var string $type
     */
    public string $type = '';

    /**
     * Event entity
     * @var OrderDTO|ShipmentDTO|null $entity
     */
    public OrderDTO|ShipmentDTO|null $entity = null;

    /**
     * @param array $fields
     * @return EventDTO
     * @throws Exception
     */
    public static function fromArray(array $fields): EventDTO
    {
        $eventDTO = new self();

        if (empty($fields['type'])) {
            throw new Exception('Event type not defined');
        }

        $eventDTO->id = intval($fields['id']);
        $eventDTO->type = EventType::getType($fields['type']);

        if (in_array($eventDTO->type, [EventType::NEW_ORDER, EventType::UPDATE_ORDER])) {
            $eventDTO->entity = OrderDTO::fromArray($fields['entity']);
        } else {
            $eventDTO->entity = ShipmentDTO::fromArray($fields['entity']);
        }

        return $eventDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => EventType::getType($this->type),
            'entity' => $this->entity->toArray()
        ];
    }
}