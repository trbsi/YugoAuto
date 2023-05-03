<?php

namespace App\Models\User;

class AdditionalPhonesCollection
{
    private array $additionalPhones;

    public function __construct(
        AdditionalPhoneValue ...$additionalPhones
    ) {
        $this->additionalPhones = $additionalPhones;
    }

    public function getPhones(): array
    {
        return $this->additionalPhones;
    }


    public function isEmpty(): bool
    {
        if (empty($this->getPhones())) {
            return true;
        }

        if (empty($this->filterEmptyNumbers())) {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        return array_map(
            static fn(AdditionalPhoneValue $phone) => $phone->toArray(),
            $this->filterEmptyNumbers()
        );
    }

    private function filterEmptyNumbers(): array
    {
        return array_values(
            array_filter(
                $this->additionalPhones,
                static fn(AdditionalPhoneValue $phone): bool => !empty($phone->getPhoneNumber())
            )
        );
    }
}
