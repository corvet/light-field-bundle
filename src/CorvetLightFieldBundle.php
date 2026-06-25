<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
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

        // 2. Налаштування AssetMapper (Замість старого Extension-класу)
        if ($builder->hasExtension('framework')) {
            $container->extension('framework', [
                'asset_mapper' => [
                    'paths' => [
                        // Вказуємо на корінь папки assets вашого бандлу
                        dirname(__DIR__) . '/assets' => '@corvet/light-field-bundle',
                    ],
                ],
            ]);
        }
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $services = $container->services();

        $services->defaults()
            ->autowire()
            ->autoconfigure();

        $services->set(Command\CorvetInstallCommand::class)
            ->tag('console.command');
    }
}
