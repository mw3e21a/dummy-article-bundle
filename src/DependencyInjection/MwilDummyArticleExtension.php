<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 28.02.2019
 * Time: 11:27
 */

namespace Mwil\DummyArticleBundle\DependencyInjection;


use Mwil\DummyArticleBundle\WordProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class MwilDummyArticleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container,new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('mwil_dummy_article_bundle.mwil_dummy_article');

        $definition->setArgument(1, $config['unicorns_are_real']);
        $definition->setArgument(2, $config['min_sunshine']);

        $container->registerForAutoconfiguration(WordProviderInterface::class)
            ->addTag('mwil_dummy_article_word_provider');

    }
}