<?php

namespace App\Utils;

interface EmailTemplatesInterface
{
    public function getMailTemplate($key);
    public function getMailSubject($key);
}
