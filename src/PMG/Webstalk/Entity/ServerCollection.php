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
     * @param   string $key The servers slug -- should be [a-z0-9-_]
     * @param   Server $server
     * @return  void
     */
    public function addServer($slug, Server $server);

    /**
     * Get a server by it's key.
     *
     * @since   1.0
     * @access  public
     * @param   string $key
     * @throws  ServerNotFoundException if the server doesn't exist in the collection
     * @return  Server
     */
    public function getServer($slug);

    /**
     * Remove an server that already exists.
     *
     * @since   1.0
     * @access  public
     * @param   string $key the servers "slug"
     * @return  boolean True if the server was removed
     */
    public function removeServer($slug);

    /**
     * Check if a server exists.
     *
     * @since   1.0
     * @access  public
     * @param   string $key The server's "slug"
     * @return  boolean
     */
    public function hasServer($slug);
}
