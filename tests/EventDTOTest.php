<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;
use SentrumDTO\Enums\EventType;

/**
 * @covers \SentrumDTO\EventDTO
 */
class EventDTOTest extends TestCase
{
    public function testNewOrderTransformation(): void
    {
        $loadedArray = DataProvider::getEvent();
        $loadedArray['type'] = EventType::NEW_ORDER;
        $loadedArray['entity'] = DataProvider::getOrder();

        $eventDTO = EventDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $eventDTO->toArray());
        $this->assertInstanceOf(OrderDTO::class, $eventDTO->entity);
    }

    public function testNewShipmentTransformation(): void
    {
        $loadedArray = DataProvider::getEvent();
        $loadedArray['type'] = EventType::NEW_SHIPMENT;
        $loadedArray['entity'] = DataProvider::getShipment();

        $eventDTO = EventDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $eventDTO->toArray());
        $this->assertInstanceOf(ShipmentDTO::class, $eventDTO->entity);
    }
}
