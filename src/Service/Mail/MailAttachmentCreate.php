<?php

namespace Dexlib\ExportUsers\Service\Mail;

class MailAttachmentCreate implements MailAttachmentCreateInterface
{
    public function createCollection(): MailAttachmentCollectionInterface
    {
        return new MailAttachmentCollection();
    }

    public function createAttachment(string $content, string $mimeType, string $filename, string $attachmentType): MailAttachmentInterface
    {
        return new MailAttachment($content, $mimeType, $filename, $attachmentType);
    }

    public function createCSVAttachmentStream(string $content, string $filename): MailAttachmentInterface
    {
        return $this->createAttachment($content, 'text/csv', $filename, MailAttachment::ATTACHMENT_TYPE_STREAM);
    }

    public function createCSVAttachmentPath(string $content, string $filename): MailAttachmentInterface
    {
        return $this->createAttachment($content, 'text/csv', $filename, MailAttachment::ATTACHMENT_TYPE_PATH);
    }
}
