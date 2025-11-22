<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver\AggregateResolver;
use Laminas\View\Resolver\TemplateMapResolver;

class MailRenderer implements MailRendererInterface
{
    private PhpRenderer $renderer;
    private array $templateMap;

    public function __construct(array $templateMap = [])
    {
        $this->renderer = new PhpRenderer();
        $this->templateMap = $templateMap;
        $this->configureRenderer();
    }

    private function configureRenderer(): void
    {
        if (!empty($this->templateMap)) {
            $resolver = new AggregateResolver();
            $map = new TemplateMapResolver($this->templateMap);
            $resolver->attach($map);
            $this->renderer->setResolver($resolver);
        }
    }

    public function addTemplate(string $name, string $path): void
    {
        $this->templateMap[$name] = $path;
        $this->configureRenderer();
    }

    public function render(string $templateName, array $data): string
    {
        if (!isset($this->templateMap[$templateName])) {
            throw new \InvalidArgumentException(
                "Template '{$templateName}' not found in template map"
            );
        }

        $viewModel = (new ViewModel(['data' => $data]))
            ->setTemplate($templateName);

        return $this->renderer->render($viewModel);
    }
}
