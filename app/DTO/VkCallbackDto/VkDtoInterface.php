<?php

namespace App\DTO\VkCallbackDto;

interface VkDtoInterface
{
    public static function createFromRequest(array $data): static;
}
