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
 * A value object that represents a list of tubes available on a given server 
 * in tube name => Statistics pairs.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface TubeList extends \IteratorAggregate, \Countable
{
    // noop
}
