<?php

namespace Dexlib\ExportUsers\Service\Export;

use Dexlib\ExportUsers\Service\Mail\EmailTemplatesInterface;
use Dexlib\ExportUsers\Service\CSV\UserCSVExportInterface;
use Dexlib\ExportUsers\Service\Mail\MailBodyBuilderInterface;
use Dexlib\ExportUsers\Service\Mail\MailSenderInterface;
use Dexlib\ExportUsers\Service\Mail\MailAttachmentCreateInterface;
use Dexlib\ExportUsers\Service\Mail\MailMessageBuilderInterface;
use Dexlib\ExportUsers\Service\Mail\EmailTemplates;
use Dexlib\ExportUsers\Utils\FilenameGeneratorInterface;

class ExportUsersService
{
    protected const USERS_PER_PAGE = 100;

    protected array $data;
    protected array $config;
    protected string $setCsvFile;
    protected UserCSVExportInterface $userCSVExport;
    protected FilenameGeneratorInterface $filenameGenerator;
    protected MailAttachmentCreateInterface $mailAttachmentCreate;
    protected MailMessageBuilderInterface $mailMessageBuilder;
    protected MailSenderInterface $smtpMailSender;
    protected MailBodyBuilderInterface $mailBodyBuilder;
    protected EmailTemplatesInterface $emailTemplates;

    public function __construct(
        array $config,
        UserCSVExportInterface $userCSVExport,
        FilenameGeneratorInterface $filenameGenerator,
        MailAttachmentCreateInterface $mailAttachmentCreate,
        MailMessageBuilderInterface $mailMessageBuilder,
        MailSenderInterface $smtpMailSender,
        MailBodyBuilderInterface $mailBodyBuilder,
        EmailTemplatesInterface $emailTemplates
    ) {
        $this->config = $config;
        $this->userCSVExport = $userCSVExport;
        $this->filenameGenerator = $filenameGenerator;
        $this->mailAttachmentCreate = $mailAttachmentCreate;
        $this->mailMessageBuilder = $mailMessageBuilder;
        $this->smtpMailSender = $smtpMailSender;
        $this->mailBodyBuilder = $mailBodyBuilder;
        $this->emailTemplates = $emailTemplates;
    }

    public function start(): void
    {
        $this->validate();
        $this->setCsvFile()->sendEmail();
    }

    protected function sendEmail(): void
    {
        $data = $this->getData();
        if (empty($this->config['mail']['to'])) {
            throw new \InvalidArgumentException('Recipient email data cannot be empty');
        }
        //attachment
        $filename = $this->filenameGenerator->generate('exportbenutzer', 'csv');
        $mailAttachmentCollection = $this->mailAttachmentCreate->createCollection();
        $mailAttachmentCollection
            ->add($this->mailAttachmentCreate
                ->createCSVAttachmentStream($this->getCsvFile(), $filename));
        $attachmentsArray = $mailAttachmentCollection->toArray();
        //build email
        $message = $this->mailMessageBuilder
            ->setSender($this->config['mail']['from'])
            ->setRecipient($this->config['mail']['to'])
            ->setSubject($this->getSubject())
            ->setBody($this->getBody())
            ->setHtml(true)
            ->setAttachment($attachmentsArray)
            ->build();
        $this->mailMessageBuilder->reset();
        //send email
        $this->smtpMailSender->send($message);
    }

    protected function getBody(): string
    {
        $mailData = $this->getData();
        return $this->mailBodyBuilder->build(
            $mailData,
            EmailTemplates::MAIL_EXPORT_USERS
        );
    }

    protected function getSubject(): string
    {
        return $this->emailTemplates->getMailSubject(EmailTemplates::MAIL_EXPORT_USERS);
    }

    protected function setCsvFile(): self
    {
        $page = 1;
        $isFirstPage = true;

        while (true) {
            $users = $this->getUsers($page);

            if (empty($users)) {
                break;
            }

            $header = $isFirstPage ? $this->getCsvHeader() : [];
            $this->userCSVExport->add($users, $header);

            $isFirstPage = false;
            $page++;
        }
        $this->setCsvFile = $this->userCSVExport->export();
        return $this;
    }

    protected function getCsvFile(): string
    {
        return $this->setCsvFile;
    }

    private function getCsvHeader(): array
    {
        $data = $this->getData();
        return array_keys($data[0]);
    }

    protected function getUsers(int $page): array
    {
        $data = $this->getData();
        $records = [];
        $max = ($page * self::USERS_PER_PAGE) - 1;
        $start = $max - self::USERS_PER_PAGE + 1;
        for ($i = $start; $i <= $max; $i++) {
            if (!empty($data[$i])) {
                $records[] = $data[$i];
            }
        }
        return $records;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    private function validate(): void
    {
        if (empty($this->data)) {
            throw new \InvalidArgumentException('Data cannot be empty');
        }
    }
}
