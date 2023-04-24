<?php

namespace SentrumDTO;

use Exception;
use SentrumDTO\Enums\EventType;

class EventDTO implements DTOInterface
{
    public int $id = 0;

    public ?EventType $type = null;

    /**
     * Event entity
     * @var LibraryDTO|OrderDTO|ShipmentDTO|null $entity
     */
    public LibraryDTO|OrderDTO|ShipmentDTO|null $entity = null;

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
        $eventDTO->type = EventType::from($fields['type']);

        if (in_array($eventDTO->type, [EventType::NEW_ORDER, EventType::UPDATE_ORDER])) {
            $eventDTO->entity = OrderDTO::fromArray($fields['entity']);
        } elseif (in_array($eventDTO->type, [EventType::NEW_SHIPMENT, EventType::UPDATE_SHIPMENT])) {
            $eventDTO->entity = ShipmentDTO::fromArray($fields['entity']);
        } elseif (in_array($eventDTO->type, [EventType::NEW_LIBRARY, EventType::UPDATE_LIBRARY])) {
            $eventDTO->entity = LibraryDTO::fromArray($fields['entity']);
        }

        return $eventDTO;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this?->type->value,
            'entity' => $this->entity->toArray()
        ];
    }
}
