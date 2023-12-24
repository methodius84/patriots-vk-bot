<?php

namespace App\DTO\VkApiDto;

class UserDto implements VkApiResponseInterface
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private bool $isClosed;
//    private ?string $bdate;
//    private ?object $city;
//    private ?object $contacts;
//    private ?object $country;
//    private ?string $photoMaxOrig;
//    private ?int $sex;
//    private ?int $verified;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->isClosed = $data['is_closed'];
        // TODO add other fields
    }

    public static function createFromResponse(array $responseData): static
    {
        // TODO: Implement createFromResponse() method.
        return new static($responseData);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }
}
