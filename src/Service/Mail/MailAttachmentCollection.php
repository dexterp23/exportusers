<?php

namespace Dexlib\ExportUsers\Service\Mail;

class MailAttachmentCollection implements MailAttachmentCollectionInterface
{
    private array $attachments = [];

    public function add(MailAttachment $attachment): void
    {
        $this->attachments[] = $attachment;
    }

    public function toArray(): array
    {
        return array_map(
            fn(MailAttachment $attachment) => $attachment->toArray(),
            $this->attachments
        );
    }
}
