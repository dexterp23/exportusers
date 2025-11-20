<?php

namespace App\Service\Mail;

use \Laminas\Mime\Mime;

class MailAttachment implements MailAttachmentInterface
{
    public const ATTACHMENT_TYPE_STREAM = 'stream';
    public const ATTACHMENT_TYPE_PATH = 'path';
    private string $content;
    private string $mimeType;
    private string $filename;
    private string $disposition;
    private string $encoding;
    private string $attachmentType;

    public function __construct(
        string $content,
        string $mimeType,
        string $filename,
        string $attachmentType,
        string $disposition = Mime::DISPOSITION_ATTACHMENT,
        string $encoding = Mime::ENCODING_BASE64
    ) {
        $this->content = $content;
        $this->mimeType = $mimeType;
        $this->filename = $filename;
        $this->disposition = $disposition;
        $this->encoding = $encoding;
        $this->attachmentType = $attachmentType;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getDisposition(): string
    {
        return $this->disposition;
    }

    public function getEncoding(): string
    {
        return $this->encoding;
    }

    public function getAttachmentType(): string
    {
        return $this->attachmentType;
    }

    public function toArray(): array
    {
        $this->validate();
        return [
            'content' => $this->content,
            'mimeType' => $this->mimeType,
            'filename' => $this->filename,
            'attachmentType' => $this->attachmentType,
            'disposition' => $this->disposition,
            'encoding' => $this->encoding,
        ];
    }

    private function validate(): void
    {
        if (empty($this->content)) {
            throw new \InvalidArgumentException('Attachment content cannot be empty');
        }

        if (empty($this->mimeType)) {
            throw new \InvalidArgumentException('Attachment mimeType cannot be empty');
        }

        if (empty($this->filename)) {
            throw new \InvalidArgumentException('Attachment filename cannot be empty');
        }

        if (empty($this->attachmentType)) {
            throw new \InvalidArgumentException('Attachment type cannot be empty');
        }
    }
}
