<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 04.03.2019
 * Time: 08:36
 */

namespace Mwil\DummyArticleBundle\Tests;


use Mwil\DummyArticleBundle\MwilDummyArticle;
use Mwil\DummyArticleBundle\MwilDummyArticleBundle;
use Mwil\DummyArticleBundle\WordProviderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{


    public function testServiceWiring()
    {
        $kernel = new MwilDummyArticleTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $dummyArticle = $container->get('mwil_dummy_article_bundle.mwil_dummy_article');

        $this->assertInstanceOf(MwilDummyArticle::class, $dummyArticle);
        $this->assertInternalType('string', $dummyArticle->getParagraphs());

    }

    public function testServiceWiringWithConfig()
    {
        $kernel = new MwilDummyArticleTestingKernel([
            'word_provider' => 'stub_word_list'
        ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        $dummyArticle = $container->get('mwil_dummy_article_bundle.mwil_dummy_article');
        $this->assertContains('stub', $dummyArticle->getWords(2));



    }

}

class MwilDummyArticleTestingKernel extends Kernel
{
    private $mwilDummyArticleConfig;

    public function __construct(array $mwilDummyArticleConfig = [])
    {
        $this->mwilDummyArticleConfig = $mwilDummyArticleConfig;
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
       return [
           new MwilDummyArticleBundle(),
       ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function(ContainerBuilder $container){
           $container->register('stub_word_list',StubWordList::class);

           $container->loadFromExtension('mwil_dummy_article', $this->mwilDummyArticleConfig);
        });
    }

    public function getCacheDir()
    {
        return __DIR__.'/..cache/'.spl_object_hash($this);
    }


}

class StubWordList implements WordProviderInterface
{


    public function getWordList(): array
    {
       return ['stub', 'stub2'];
    }
}
