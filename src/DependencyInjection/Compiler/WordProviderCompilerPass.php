<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 07.03.2019
 * Time: 10:08
 */

namespace Mwil\DummyArticleBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WordProviderCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('mwil_dummy_article_bundle.mwil_dummy_article');
        $references = array();
        foreach ($container->findTaggedServiceIds('mwil_dummy_article_word_provider') as $id =>$tags) {
           $references[] = new Reference($id);
        }

        $definition->setArgument(0,$references);
    }
}