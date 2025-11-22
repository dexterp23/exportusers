<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailMessageBuilderInterface
{
    public function setSender(string $sender): self;
    public function setRecipient(string $recipient): self;
    public function setSubject(string $subject): self;
    public function setBody(string $body): self;
    public function setHtml(bool $isHtml): self;
    public function setAttachment($attachment): self;
    public function build(): MailMessageInterface;
    public function reset(): self;
}
