<?php

namespace SentrumDTO;

use SentrumDTO\Enums\LibraryType;

class LibraryDTO implements DTOInterface
{
    public int $id = 0;
    public string $xmlId = '';
    public string $name = '';
    public string $shortName = '';
    public ?LibraryType $type = null;
    public string $website = '';
    public ?AddressDTO $billTo = null;

    /** @var AddressDTO[] $shipTo */
    public array $shipTo = [];

    /**
     * @inheritDoc
     */
    public static function fromArray(array $fields): LibraryDTO
    {
        $libraryDto = new self();

        $libraryDto->id = !empty($fields['id']) ? intval($fields['id']) : 0;
        $libraryDto->xmlId = !empty($fields['xml_id']) ? $fields['xml_id'] : '';
        $libraryDto->name = !empty($fields['name']) ? $fields['name'] : '';
        $libraryDto->shortName = !empty($fields['short_name']) ? $fields['short_name'] : '';
        $libraryDto->type = empty($fields['type']) ? LibraryType::OTHER : (LibraryType::tryFrom($fields['type']) ?: LibraryType::OTHER);
        $libraryDto->website = !empty($fields['website']) ? $fields['website'] : '';

        $libraryDto->billTo = is_array($fields['bill_to']) ? AddressDTO::fromArray($fields['bill_to']) : null;

        if (is_array($fields['ship_to'])) {
            foreach ($fields['ship_to'] as $shipTo) {
                if (is_array($shipTo)) {
                    $libraryDto->shipTo[] = AddressDTO::fromArray($shipTo);
                }
            }
        }

        return $libraryDto;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'xml_id' => $this->xmlId,
            'name' => $this->name,
            'short_name' => $this->shortName,
            'type' => $this->type->value,
            'website' => $this->website,
            'bill_to' => $this->billTo ? $this->billTo->toArray() : [],
            'ship_to' => array_map(function ($shipTo) {
                return $shipTo->toArray();
            }, $this->shipTo)
        ];
    }
}
