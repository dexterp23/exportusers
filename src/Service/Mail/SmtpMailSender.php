<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Laminas\Mail\Transport\Smtp;

class SmtpMailSender implements MailSenderInterface
{
    protected SmtpOptionsInterface $smtpOptions;
    protected LaminasMailMessageBuilderInterface $laminasMailMessageBuilder;

    public function __construct(
        SmtpOptionsInterface $smtpOptions,
        LaminasMailMessageBuilderInterface $laminasMailMessageBuilder,
    ) {
        $this->smtpOptions = $smtpOptions;
        $this->laminasMailMessageBuilder = $laminasMailMessageBuilder;
    }

    public function send(MailMessageInterface $messageData): void
    {
        try {
            $transport = new Smtp();
            $transport->setOptions($this->smtpOptions->getSmtpOptions());

            $message = $this->laminasMailMessageBuilder->build($messageData);

            $transport->send($message);
        } catch (\Throwable $e) {
            $errors = $e->getMessage();
            throw new \RuntimeException($errors);
        }
    }
}
