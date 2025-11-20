<?php

namespace App\Service\Mail;

use Laminas\Mime\Part;

class LaminasMailPartBuilder implements LaminasMailPartBuilderInterface
{
    public function create(MailMessageInterface $data): Part
    {
        $part = new Part($data->getBody());
        $part->type = $data->hasHtml()
            ? "text/html; charset=UTF-8"
            : "text/plain; charset=UTF-8";

        return $part;
    }
}
