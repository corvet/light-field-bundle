<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class CorvetLightFieldExtension extends Extension implements PrependExtensionInterface
{
    /**
     * Завантаження сервісів (вашого B01DateType)
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        // Завантажуємо конфігурацію сервісів з config/services.php
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.php');
    }

    /**
     * Автоматична конфігурація сторонніх бандлів (AssetMapper та Twig)
     */
    public function prepend(ContainerBuilder $container): void
    {
        // 1. Автоматична реєстрація ассетів в AssetMapper
        if ($container->hasExtension('framework')) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        // Відображаємо папку assets бандлу на npm-простір імен
                        dirname(__DIR__, 2) . '/assets' => '@corvet/light-field-bundle',
                    ],
                ],
            ]);
        }

        // 2. Автоматична реєстрація Form Theme в Twig
        if ($container->hasExtension('twig')) {
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    dirname(__DIR__, 2) . '/templates' => 'CorvetLightFieldBundle',
                ],
                'form_themes' => [
                    '@CorvetLightFieldBundle/form_theme.html.twig',
                ],
            ]);
        }
    }

    /**
     * Офіційний UX-стиль вимагає унікального аліасу конфігурації в dependency injection.
     * За замовчуванням Symfony згенерує "sb_privat_b01".
     */
    public function getAlias(): string
    {
        return 'sb_privat_b01';
    }
}
