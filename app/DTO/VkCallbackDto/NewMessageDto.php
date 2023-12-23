<?php

namespace App\DTO\VkCallbackDto;

class NewMessageDto implements VkObjectDtoInterface
{
    private MessageDto $message;
    private ClientInfoDto $client;

    public function __construct(array $messageData, array $clientData)
    {
        $this->message = MessageDto::createFromArray($messageData);
        $this->client = ClientInfoDto::createFromArray($clientData);
    }

    public static function createFromArray(array $data): static
    {
        return new static($data['message'], $data['client_info']);
    }

    public function getMessage(): MessageDto
    {
        return $this->message;
    }

    public function getClient(): ClientInfoDto
    {
        return $this->client;
    }
}
