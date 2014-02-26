<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use PMG\Webstalk\Provider\WebstalkServiceProvider;
use PMG\Webstalk\Provider\WebstalkControllerProvider;

/**
 * This tests the entire system end-to-end.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class WebTest extends \Silex\WebTestCase
{
    public function testServersPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        // should have a 200 resonse
        $this->assertTrue($client->getResponse()->isOk());

        // we should have a header that says servers
        $this->assertCount(1, $crawler->filterXpath('//h1[@class="webstalk-title" and text()="Servers"]'));
    }

    /**
     * @expectedException PMG\Webstalk\Exception\AdapterException
     */
    public function testServersPageWithoutBeanstalk()
    {
        $this->app['exception_handler']->disable();
        // make it fail!
        $this->app['webstalk.default_servers'] = [
            'default' => [
                'name'  => 'Default',
                'host'  => getenv('BEANSTALKD_HOST') ?: 'localhost',
                'port'  => (getenv('BEANSTALKD_PORT') ?: 11300) + 2,
            ]
        ];

        $this->createClient()->request('GET', '/');
    }

    public function testTubesPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/default/');

        // should have a 200
        $this->assertTrue($client->getResponse()->isOk());

        // should have a header with the server name
        $this->assertCount(1, $crawler->filterXpath('//h1[@class="webstalk-title" and text()="Default Tubes"]'));
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
     */
    public function testTubesPageWithBadServer()
    {
        $this->app['exception_handler']->disable();

        $this->createClient()->request('GET', '/not_a_real_server/');
    }

    public function createApplication()
    {
        $app = new Application();

        $app['debug'] = true;

        $app->register(new TwigServiceProvider());
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new WebstalkServiceProvider(), [
            'webstalk.default_servers' => [
                'default'   => [
                    'name'      => 'Default',
                    'host'      => getenv('BEANSTALKD_HOST') ?: 'localhost',
                    'port'      => getenv('BEANSTALKD_PORT') ?: 11300,
                ]
            ]
        ]);
        $app->mount('/', new WebstalkControllerProvider());

        return $app;
    }
}
