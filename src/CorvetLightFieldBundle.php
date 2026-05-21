<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class CorvetLightFieldBundle extends AbstractBundle
{
    /**
     * Цей метод викликається автоматично ДO того, як завантажаться основні сервіси.
     * Тут ми "підмішуємо" (prepend) наші налаштування в Twig, якщо він увімкнений у проекті.
     */
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Перевіряємо, чи взагалі у додатку встановлено і увімкнено TwigBundle
        if ($builder->hasExtension('twig')) {
            $container->extension('twig', [
                'paths' => [
                    dirname(__DIR__) . '/templates' => 'CorvetLightField',
                ],
                'form_themes' => [
                    '@CorvetLightField/form_theme.html.twig',
                ],
            ]);
        }
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Метод можна залишити порожнім, якщо ми не реєструємо власні PHP-сервіси через сервіс-контейнер.
        // Уся робота з Twig тепер безпечно перенесена в prependExtension.
    }
}
