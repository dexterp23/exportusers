<?php

namespace App\Service\Mail;

use Psr\Container\ContainerInterface;

class LaminasMailMessageBuilderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $laminasMailPartBuilder = new LaminasMailPartBuilder();
        $laminasMailAttachmentBuilder = new LaminasMailAttachmentBuilder();

        return new LaminasMailMessageBuilder(
            $laminasMailPartBuilder,
            $laminasMailAttachmentBuilder
        );
    }
}