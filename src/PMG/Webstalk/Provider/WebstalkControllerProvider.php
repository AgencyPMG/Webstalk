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
use Silex\ControllerProviderInterface;

/**
 * Add the webstalk routes to the application
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class WebstalkControllerProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $c = $app['webstalk.controllers'];

        $c->get('/', 'webstalk.controller:listServersAction')
            ->bind('webstalk.servers');

        $c->get('/{slug}/', 'webstalk.controller:listTubesAction')
            ->assert('slug', '[A-Za-z0-9-_.]')
            ->bind('webstalk.tubes');

        return $c;
    }
}
