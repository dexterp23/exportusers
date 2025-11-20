<?php

namespace App\Service\Mail;

interface MailAttachmentCollectionInterface
{
    public function add(MailAttachment $attachment): void;
}
