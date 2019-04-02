<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 07.03.2019
 * Time: 08:31
 */

namespace Mwil\DummyArticleBundle\Tests\Controller;


use Mwil\DummyArticleBundle\MwilDummyArticleBundle;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class DummyArticleApiControllerTest extends TestCase
{
    public function testIndex()
    {
        $kernel = new MwilDummyArticleControllerKernel();
        $client = new Client($kernel);
        $client->request('GET', '/api/');

        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }

}

class MwilDummyArticleControllerKernel extends Kernel
{


    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new MwilDummyArticleBundle(),
            new FrameworkBundle()
        ];
    }


    public function getCacheDir()
    {
        return __DIR__.'/cache/'.spl_object_hash($this);
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__.'/../../src/Resources/config/routes.xml', '/api');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', [
            'secret' => 'P00'
        ]);
    }


}