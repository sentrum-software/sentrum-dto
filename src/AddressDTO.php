<?php

namespace SentrumDTO;

class AddressDTO implements DTOInterface
{
    public int $id = 0;
    public string $libraryName = '';
    public string $attentionTo = '';
    public array $emails = [];
    public string $zip = '';
    public string $country = '';
    public string $state = '';
    public string $city = '';
    public string $street = '';

    public static function fromArray(array $fields): AddressDTO
    {
        $addressDto = new self();

        $addressDto->id = !empty($fields['id']) ? intval($fields['id']) : 0;
        $addressDto->libraryName = !empty($fields['library_name']) ? $fields['library_name'] : '';
        $addressDto->attentionTo = !empty($fields['attention_to']) ? $fields['attention_to']: '';
        $addressDto->emails = is_array($fields['emails']) ? $fields['emails'] : [];
        $addressDto->zip = !empty($fields['zip']) ? $fields['zip']: '';
        $addressDto->country = !empty($fields['country']) ? $fields['country']: '';
        $addressDto->state = !empty($fields['state']) ? $fields['state']: '';
        $addressDto->city = !empty($fields['city']) ? $fields['city']: '';
        $addressDto->street = !empty($fields['street']) ? $fields['street']: '';

        return $addressDto;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'library_name' => $this->libraryName,
            'attention_to' => $this->attentionTo,
            'emails' => $this->emails,
            'zip' => $this->zip,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'street' => $this->street
        ];
    }
}
