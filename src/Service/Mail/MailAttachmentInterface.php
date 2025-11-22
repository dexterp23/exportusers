<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailAttachmentInterface
{
    public function getContent(): string;
    public function getMimeType(): string;
    public function getFilename(): string;
    public function getDisposition(): string;
    public function getEncoding(): string;
    public function getAttachmentType(): string;
}