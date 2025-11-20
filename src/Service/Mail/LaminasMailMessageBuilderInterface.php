<?php

namespace App\Service\Mail;

use Laminas\Mail\Message;

interface LaminasMailMessageBuilderInterface
{
    public function build(MailMessageInterface $data): Message;
}
