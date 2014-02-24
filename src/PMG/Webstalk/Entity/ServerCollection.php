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
 * A collection of servers with an API for adding and removing them.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface ServerCollection extends \IteratorAggregate, \Countable
{
    /**
     * Add a new sever.
     *
     * @since   1.0
     * @access  public
     * @param   Server
     * @return  void
     */
    public function addServer(Server $server);
}
