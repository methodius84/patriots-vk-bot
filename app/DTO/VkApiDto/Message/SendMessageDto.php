<?php

namespace App\DTO\VkApiDto\Message;

use App\DTO\VkApiDto\VkApiResponseInterface;

class SendMessageDto implements VkApiResponseInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param int $responseData
     * @return static
     */
    public static function createFromResponse(mixed $responseData): static
    {
        return new static($responseData);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
