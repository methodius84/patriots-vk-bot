<?php

namespace App\DTO\VkCallbackDto;

use Illuminate\Support\Facades\Log;

class MessageDto
{

    private int $date;
    private int $fromId;
    private int $id;
    private int $out;
    private int $version;
    private array $attachments;
    private int $conversationMessageId;
    private array $fwdMessages;

    private bool $important;
    private bool $isHidden;
    private ?array $payload;

    private int $peerId;
    private int $randomId;

    private string $text;

    public function __construct(array $data)
    {
        $this->date = $data['date'];
        $this->fromId = $data['from_id'];
        $this->id = $data['id'];
        $this->out = $data['out'];
        $this->version = $data['version'];
        $this->attachments = $data['attachments'];
        $this->conversationMessageId = $data['conversation_message_id'];
        $this->fwdMessages = $data['fwd_messages'];
        $this->important = $data['important'];
        $this->isHidden = $data['is_hidden'];
        $this->peerId = $data['peer_id'];
        $this->payload = isset($data['payload']) ? json_decode($data['payload'], true): [];
        $this->randomId = $data['random_id'];
        $this->text = $data['text'];
    }
    public static function createFromArray(array $data): static
    {
        return new static($data);
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOut(): int
    {
        return $this->out;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function getConversationMessageId(): int
    {
        return $this->conversationMessageId;
    }

    public function getFwdMessages(): array
    {
        return $this->fwdMessages;
    }

    public function isImportant(): bool
    {
        return $this->important;
    }

    public function isHidden(): bool
    {
        return $this->isHidden;
    }

    public function getPeerId(): int
    {
        return $this->peerId;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }

    public function getRandomId(): int
    {
        return $this->randomId;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
