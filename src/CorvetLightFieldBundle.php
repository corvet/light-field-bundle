<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle;

use Corvet\LightFieldBundle\DependencyInjection\CorvetLightFieldExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SbPrivatB01Bundle extends Bundle
{
    /**
     * За замовчуванням Symfony шукає Extension за назвою бандлу.
     * Якщо назва класу SbPrivatB01Bundle, то очікується SbPrivatB01Extension.
     * Якщо структура стандартна, цей метод можна навіть не перевизначати,
     * але для надійності та контролю ми його залишаємо.
     */
    protected function getContainerExtensionClass(): string
    {
        return CorvetLightFieldExtension::class;
    }
}
