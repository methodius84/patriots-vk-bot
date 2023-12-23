<?php

namespace App\DTO\VkCallbackDto;

class VkNewEventDto implements VkDtoInterface
{
    private int $groupId;
    private string $type;
    private string $eventId;
    private string $apiVersion;
    private VkObjectDtoInterface $object;
    private string $secret;

    public function __construct(array $data, VkObjectDtoInterface $object)
    {
        $this->groupId = $data['group_id'];
        $this->type = $data['type'];
        $this->eventId = $data['event_id'];
        $this->apiVersion = $data['v'];
        $this->object = $object;
        $this->secret = $data['secret'];
    }

    public static function createFromRequest(array $data): static
    {
        $object = match ($data['type']) {
            'message_new' => NewMessageDto::createFromArray($data['object']),
            'message_event' => MessageEventDto::createFromArray($data['object']),
//            'wall_reply_new' => NewReplyDto::createFromArray($data['object']),
        };
        return new static($data, $object);
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getClientInfo(): ClientInfoDto
    {
        return $this->clientInfo;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getObject(): VkObjectDtoInterface
    {
        return $this->object;
    }
}
