<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailAttachmentCreateInterface
{
    public function createAttachment(string $content, string $mimeType, string $filename, string $attachmentType): MailAttachmentInterface;
}
