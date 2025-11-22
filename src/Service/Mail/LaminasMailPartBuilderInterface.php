<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Laminas\Mime\Part;

interface LaminasMailPartBuilderInterface
{
    public function create(MailMessageInterface $data): Part;
}
