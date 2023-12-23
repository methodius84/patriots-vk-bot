<?php

namespace App\DTO\VkApiDto;

interface VkApiResponseInterface
{
    public static function createFromResponse(array $responseData): static;
}
