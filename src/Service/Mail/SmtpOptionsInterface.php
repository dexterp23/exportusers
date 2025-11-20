<?php

namespace App\Service\Mail;

use Laminas\Mail\Transport\SmtpOptions as LaminasSmtpOptions;

interface SmtpOptionsInterface
{
    public function getSmtpOptions(): LaminasSmtpOptions;
}