<?php

declare(strict_with=1);

namespace Corvet\LightFieldBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class CorvetLightFieldBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Реєструємо наш шлях до Twig-шаблонів бандлу
        $container->extension('twig', [
            'paths' => [
                dirname(__DIR__) . '/templates' => 'CorvetLightField',
            ],
        ]);

        // Автоматично додаємо наш шаблон до списку глобальних Form Themes основного додатка
        $container->extension('twig', [
            'form_themes' => [
                '@CorvetLightField/form_theme.html.twig',
            ],
        ]);
    }
}
