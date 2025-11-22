<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Laminas\Mime\Part;

class LaminasMailAttachmentBuilder implements LaminasMailAttachmentBuilderInterface
{
    public function createMany(?array $attachments): array
    {
        if (!is_array($attachments)) {
            return [];
        }

        $parts = [];

        foreach ($attachments as $attachment) {
            $content = $this->resolveContent($attachment);

            $part = new Part($content);
            $part->type        = $attachment['mimeType'];
            $part->filename    = $attachment['filename'];
            $part->disposition = $attachment['disposition'];
            $part->encoding    = $attachment['encoding'];

            $parts[] = $part;
        }

        return $parts;
    }

    private function resolveContent(array $attachment): mixed
    {
        switch ($attachment['attachmentType']) {
            case MailAttachment::ATTACHMENT_TYPE_STREAM:
                return $attachment['content'];
                break;
            case MailAttachment::ATTACHMENT_TYPE_PATH:
                return fopen($attachment['content'], 'r');
                break;
            default:
                throw new \InvalidArgumentException("Invalid attachment type");
        }
    }
}
