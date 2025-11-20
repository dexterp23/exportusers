<?php

namespace App\Service\Mail;

use Laminas\Mail\Message;
use Laminas\Mime\Message as MimeMessage;

class LaminasMailMessageBuilder implements LaminasMailMessageBuilderInterface
{
    protected LaminasMailPartBuilderInterface $laminasMailPartBuilder;
    protected LaminasMailAttachmentBuilderInterface $laminasMailAttachmentBuilder;

    public function __construct(
        LaminasMailPartBuilderInterface $laminasMailPartBuilder,
        LaminasMailAttachmentBuilderInterface $laminasMailAttachmentBuilder,
    ) {
        $this->laminasMailPartBuilder = $laminasMailPartBuilder;
        $this->laminasMailAttachmentBuilder = $laminasMailAttachmentBuilder;
    }

    public function build(MailMessageInterface $data): Message
    {
        $message = new Message();
        $message->setEncoding('UTF-8');
        $message->setFrom($data->getSender());
        $message->setTo($data->getRecipient());
        $message->setSubject($data->getSubject());

        $parts = [];
        $parts[] = $this->laminasMailPartBuilder->create($data);

        foreach ($this->laminasMailAttachmentBuilder->createMany($data->getAttachment()) as $attachmentPart) {
            $parts[] = $attachmentPart;
        }

        $mimeMessage = new MimeMessage();
        $mimeMessage->setParts($parts);

        $message->setBody($mimeMessage);

        return $message;
    }
}
