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

$app = new \Silex\Application();

$app['debug'] = true;

$app->run();
