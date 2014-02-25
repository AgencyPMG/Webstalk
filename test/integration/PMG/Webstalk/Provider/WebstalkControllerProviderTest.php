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

class WebstalkControllerProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $app = new Application();
        $app['webstalk.controllers'] = $app['controllers_factory'];

        $app->mount('/', new WebstalkControllerProvider());
    }
}
