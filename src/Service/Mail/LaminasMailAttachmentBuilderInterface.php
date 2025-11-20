<?php

namespace App\Service\Mail;

interface LaminasMailAttachmentBuilderInterface
{
    public function createMany(?array $attachments): array;
}