<?php

namespace App\DTO\VkCallbackDto;

class MessageEventDto implements VkObjectDtoInterface
{
    private int $userId;
    private int $peerId;
    private string $eventId;
    //TODO мы знаем, что за payload содержится в кнопке. надо привести к единому виду.
    private mixed $payload;
    private ?int $conversationMessageId;
    public function __construct(array $data)
    {
        $this->userId = $data['user_id'];
        $this->peerId = $data['peer_id'];
        $this->eventId = $data['event_id'];
        $this->payload = $data['payload'];
        $this->conversationMessageId = $data['conversation_message_id'] ?? null;
    }

    public static function createFromArray(array $data): static
    {
        return new static($data);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPeerId(): int
    {
        return $this->peerId;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getPayload(): mixed
    {
        return $this->payload;
    }
}
