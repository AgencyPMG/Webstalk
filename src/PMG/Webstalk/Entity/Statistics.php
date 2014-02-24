<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Entity;

/**
 * A value objects that represents the the key => value pairs of statistics for
 * the queue server. A marker interface.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface Statistics extends \ArrayAccess, \IteratorAggregate, \Countable
{
    // noop
}
