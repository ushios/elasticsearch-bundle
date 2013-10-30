<?php

namespace Ushios\Bundle\ElasticSearchBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UshiosElasticSearchExtensionTest extends WebTestCase
{
    /**
     * service container.
     */
    protected $container;

    /**
     * Setup test.
     *  @return null
     */
    public function setUp()
    {
        $this->app = new \AppKernel('test', true);
        $this->app->boot();
        $this->container = $this->app->getContainer();

        parent::setUp();
    }

    /**
     * Test getting aws client.
     * @return null
     */
    public function testGetEsClient()
    {
        /*
        $es = $this->container->get('ushios_elastic_search_client.default');
        
        $this->assertInstanceOf('\ElasticSearch\Client', $es);
        */
    }
}
