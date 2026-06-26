<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle;

use Corvet\LightFieldBundle\DependencyInjection\CorvetLightFieldExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CorvetLightFieldBundle extends Bundle
{
    protected function getContainerExtensionClass(): string
    {
        return CorvetLightFieldExtension::class;
    }
}
