<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailMessageInterface
{
    public function getSender(): string;
    public function getRecipient(): string;
    public function getSubject(): string;
    public function getBody(): string;
    public function hasHtml(): bool;
    public function getAttachment(): array;
}
