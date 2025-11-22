<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface LaminasMailAttachmentBuilderInterface
{
    public function createMany(?array $attachments): array;
}
