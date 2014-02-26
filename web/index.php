<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

require __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use PMG\Webstalk\Provider\WebstalkServiceProvider;
use PMG\Webstalk\Provider\WebstalkControllerProvider;

$app = new Application();

$app['debug'] = true;

$app->register(new TwigServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new WebstalkServiceProvider());
$app->mount('/', new WebstalkControllerProvider());

$app->run();
