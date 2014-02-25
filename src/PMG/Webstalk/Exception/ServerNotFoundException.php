<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Exception;

/**
 * Throw when a server can't be found in a server collection.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class ServerNotFoundException extends \InvalidArgumentException implements WebstalkException
{
    // noop
}
