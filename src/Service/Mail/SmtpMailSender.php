<?php

namespace App\Service\Mail;

use Laminas\Mail\Transport\Smtp;
use Psr\Log\LoggerInterface;

class SmtpMailSender implements MailSenderInterface
{
    protected SmtpOptionsInterface $smtpOptions;
    protected LaminasMailMessageBuilderInterface $laminasMailMessageBuilder;
    protected LoggerInterface $logger;

    public function __construct(
        SmtpOptionsInterface $smtpOptions,
        LaminasMailMessageBuilderInterface $laminasMailMessageBuilder,
        LoggerInterface $logger
    ) {
        $this->smtpOptions = $smtpOptions;
        $this->laminasMailMessageBuilder = $laminasMailMessageBuilder;
        $this->logger = $logger;
    }

    public function send(MailMessageInterface $messageData): void
    {
        try {
            $transport = new Smtp();
            $transport->setOptions($this->smtpOptions->getSmtpOptions());

            $message = $this->laminasMailMessageBuilder->build($messageData);

            $transport->send($message);

        } catch (\Throwable $e) {
            $this->logger->debug("SmtpMailService: " . $e->getMessage());
            $errors = $e->getMessage();
            throw new \RuntimeException($errors);
        }
    }
}
