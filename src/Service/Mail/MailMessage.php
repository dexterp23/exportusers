<?php

namespace Dexlib\ExportUsers\Service\Mail;

class MailMessage implements MailMessageInterface
{
    private string $sender;
    private string $recipient;
    private string $subject;
    private string $body;
    private bool $isHtml;
    private array $attachment;

    public function __construct(
        string $sender,
        string $recipient,
        string $subject,
        string $body,
        bool $isHtml = false,
        array $attachment = []
    ) {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->body = $body;
        $this->isHtml = $isHtml;
        $this->attachment = $attachment;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function hasHtml(): bool
    {
        return $this->isHtml;
    }

    public function getAttachment(): array
    {
        return $this->attachment;
    }
}
