<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SentrumDTO\EventResultDTO
 */
class EventResultDTOTest extends TestCase
{
    public function testSuccessTransformation(): void
    {
        $loadedArray = DataProvider::getEventResult();

        $eventResultDTO = EventResultDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $eventResultDTO->toArray());
    }

    public function testWrongTransformation(): void
    {
        $loadedArray = DataProvider::getEventResult();
        $loadedArray['error_message'] = '';

        $this->expectExceptionMessage('Error message can\'t be empty for failed result.');

        $eventResultDTO = EventResultDTO::fromArray($loadedArray);
    }
}
