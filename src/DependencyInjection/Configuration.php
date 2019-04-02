<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 28.02.2019
 * Time: 12:28
 */

namespace Mwil\DummyArticleBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mwil_dummy_article');

        $rootNode
            ->children()
                ->booleanNode('unicorns_are_real')->defaultTrue()->end()
                ->integerNode('min_sunshine')->defaultValue(3)->end()
                ->scalarNode('word_provider')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;

    }
}