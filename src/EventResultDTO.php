<?php

namespace SentrumDTO;

use Exception;

class EventResultDTO implements DTOInterface
{
    public int $eventId = 0;
    public bool $success = false;
    public string $errorMessage = '';

    /**
     * @param array $fields
     * @return EventResultDTO
     * @throws Exception
     */
    public static function fromArray(array $fields): EventResultDTO
    {
        $eventResultDTO = new self();

        $eventResultDTO->eventId = isset($fields['event_id']) ? intval($fields['event_id']) : 0;
        $eventResultDTO->success = isset($fields['success']) ? boolval($fields['success']) : false;
        $eventResultDTO->errorMessage = isset($fields['error_message']) ? (string)$fields['error_message'] : '';

        if (
            !$eventResultDTO->success
            && empty($eventResultDTO->errorMessage)
        ) {
            throw new Exception('Error message can\'t be empty for failed result.');
        }

        return $eventResultDTO;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        if (
            !$this->success
            && empty($this->errorMessage)
        ) {
            throw new Exception('Error message can\'t be empty for failed result.');
        }
        return [
            'event_id' => intval($this->eventId),
            'success' => boolval($this->success),
            'error_message' => (string)$this->errorMessage
        ];
    }
}