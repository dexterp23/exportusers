<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailAttachmentCollectionInterface
{
    public function add(MailAttachment $attachment): void;
    public function toArray(): array;
}
