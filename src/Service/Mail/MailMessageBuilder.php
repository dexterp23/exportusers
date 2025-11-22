<?php

namespace Dexlib\ExportUsers\Service\Mail;

class MailMessageBuilder implements MailMessageBuilderInterface
{
    private ?string $sender = null;
    private ?string $recipient = null;
    private ?string $subject = null;
    private ?string $body = null;
    private bool $isHtml = false;
    private ?array $attachment = [];

    public function setSender(string $sender): self
    {
        $this->sender = $sender;
        return $this;
    }

    public function setRecipient(string $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function setHtml(bool $isHtml): self
    {
        $this->isHtml = $isHtml;
        return $this;
    }

    public function setAttachment($attachment): self
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function build(): MailMessageInterface
    {
        $this->validate();

        return new MailMessage(
            $this->sender,
            $this->recipient,
            $this->subject,
            $this->body,
            $this->isHtml,
            $this->attachment
        );
    }

    private function validate(): void
    {
        if (empty($this->sender)) {
            throw new \InvalidArgumentException('Sender is required');
        }

        if (empty($this->recipient)) {
            throw new \InvalidArgumentException('Recipient is required');
        }

        if (empty($this->subject)) {
            throw new \InvalidArgumentException('Subject is required');
        }

        if (empty($this->body)) {
            throw new \InvalidArgumentException('Body is required');
        }
    }

    public function reset(): self
    {
        $this->sender = null;
        $this->recipient = null;
        $this->subject = null;
        $this->body = null;
        $this->isHtml = false;
        $this->attachment = [];

        return $this;
    }
}
