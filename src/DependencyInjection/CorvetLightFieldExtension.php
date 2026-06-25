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
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.php');
    }

    /**
     * Автоматична конфігурація сторонніх бандлів (AssetMapper та Twig)
     */
    public function prepend(ContainerBuilder $container): void
    {
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

    public function getAlias(): string
    {
        return 'corvet__light_field';
    }
}
