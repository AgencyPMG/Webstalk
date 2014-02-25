<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Provider;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

class WebstalkServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function instanceProvider()
    {
        return [
            ['webstalk.controllers', 'Silex\\ControllerCollection'],
            ['webstalk.factory', 'PMG\\Webstalk\\Adapter\\AdapterFactory'],
            ['webstalk.servers', 'PMG\\Webstalk\\Entity\\ServerCollection'],
            ['webstalk.templates', 'PMG\\Webstalk\\Adapter\\TemplateEngine'],
            ['webstalk.controller', 'PMG\\Webstalk\\Controller\\WebstalkController']
        ];
    }

    /**
     * @dataProvider instanceProvider
     */
    public function testInstances($key, $cls)
    {
        $this->assertTrue(isset($this->app[$key]));
        $this->assertInstanceOf($cls, $this->app[$key]);
    }

    protected function setUp()
    {
        $this->app = new Application();
        $this->app->register(new TwigServiceProvider());
        $this->app->register(new WebstalkServiceProvider());
    }
}
