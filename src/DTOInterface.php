<?php

namespace SentrumDTO;

use Exception;

interface DTOInterface
{
    /**
     * Create DTO object from given array
     * @param array $fields
     * @return DTOInterface
     * @throws Exception
     */
    public static function fromArray(array $fields): DTOInterface;

    /**
     * Convert DTO to array
     * @return array
     */
    public function toArray(): array;
}
