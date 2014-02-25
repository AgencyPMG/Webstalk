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
use Silex\ServiceProviderInterface;
use PMG\Webstalk\Adapter\TwigTemplateEngine;
use PMG\Webstalk\Entity\DefaultServer;
use PMG\Webstalk\Entity\DefaultServerCollection;
use PMG\Webstalk\Controller\WebstalkController;

/**
 * Integrates our webstalk classes with silex.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class WebstalkServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        // define our own service for a controllers factory, let's users hook
        // in an extend it should they choose.
        $app['webstalk.controllers'] = function ($app) {
            return $app['controllers_factory'];
        };

        $app['webstalk.factory.class'] = 'PMG\\Webstalk\\Adapter\\PheanstalkAdapterFactory';
        $app['webstalk.factory'] = $app->share(function ($app) {
            return new $app['webstalk.factory.class']();
        });

        $app['webstalk.default_servers'] = [
            'default'   => [
                'name'  => 'Default',
                'host'  => 'localhost',
                'port'  => 11300,
            ]
        ];

        $app['webstalk.servers'] = $app->share(function ($app) {
            $col = new DefaultServerCollection();
            foreach ($app['webstalk.default_servers'] as $slug => $server) {
                $col->addServer($slug, new DefaultServer(
                    $server['host'],
                    $server['port'],
                    isset($server['name']) ? $server['name'] : null
                ));
            }

            return $col;
        });

        $app['webstalk.templates'] = $app->share(function ($app) {
            return new TwigTemplateEngine($app['twig']);
        });

        $app['webstalk.controller'] = $app->share(function ($app) {
            return new WebstalkController(
                $app['webstalk.templates'],
                $app['webstalk.factory'],
                $app['webstalk.servers']
            );
        });

        $app['twig.loader.filesystem'] = $app->share($app->extend('twig.loader.filesystem', function ($loader) {
            $loader->addPath(__DIR__ . '/../Resources/views', 'webstalk');
            return $loader;
        }));
    }

    // @codeCoverageIgnoreStart
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app) { }
    // @codeCoverageIgnoreEnd
}
