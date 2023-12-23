<?php

namespace App\DTO\VkCallbackDto;

interface VkObjectDtoInterface
{
    public static function createFromArray(array $data): static;
}
