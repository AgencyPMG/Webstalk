<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('PMG\\Webstalk', __DIR__ . '/unit');
$loader->add('PMG\\Webstalk', __DIR__ . '/integration');
