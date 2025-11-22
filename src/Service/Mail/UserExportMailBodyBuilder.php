<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Dexlib\ExportUsers\Utils\EmailTemplatesInterface;

class UserExportMailBodyBuilder implements MailBodyBuilderInterface
{
    protected const MAIL_TEMPLATE_NAME = 'mailTemplate';
    private MailDataEnricherInterface $dataEnricher;
    private MailRendererInterface $renderer;
    private EmailTemplatesInterface $emailTemplates;

    public function __construct(
        MailDataEnricherInterface $dataEnricher,
        MailRendererInterface $renderer,
        EmailTemplatesInterface $emailTemplates
    ) {
        $this->dataEnricher = $dataEnricher;
        $this->renderer = $renderer;
        $this->emailTemplates = $emailTemplates;
    }

    public function build(array $mailData, string $templateType): string
    {
        $enrichedData = $this->dataEnricher->enrich($mailData);

        $templatePath = $this->emailTemplates->getMailTemplate($templateType);

        if ($this->renderer instanceof MailRenderer) {
            $this->renderer->addTemplate(self::MAIL_TEMPLATE_NAME, $templatePath);
        }

        return $this->renderer->render(self::MAIL_TEMPLATE_NAME, $enrichedData);
    }
}
