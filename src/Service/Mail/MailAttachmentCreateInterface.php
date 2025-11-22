<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailAttachmentCreateInterface
{
    public function createCollection(): MailAttachmentCollectionInterface;
    public function createAttachment(
        string $content,
        string $mimeType,
        string $filename,
        string $attachmentType
    ): MailAttachmentInterface;
    public function createCSVAttachmentStream(
        string $content,
        string $filename
    ): MailAttachmentInterface;
    public function createCSVAttachmentPath(
        string $content,
        string $filename
    ): MailAttachmentInterface;
}
