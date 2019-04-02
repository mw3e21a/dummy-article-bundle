<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 28.02.2019
 * Time: 11:24
 */

namespace Mwil\DummyArticleBundle;


use Mwil\DummyArticleBundle\DependencyInjection\Compiler\WordProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MwilDummyArticleBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
       $container->addCompilerPass(new WordProviderCompilerPass());
    }

}