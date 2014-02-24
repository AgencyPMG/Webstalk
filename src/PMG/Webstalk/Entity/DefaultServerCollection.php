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
 * Default implementation of ServerCollection
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class DefaultServerCollection implements ServerCollection
{
    /**
     * The servers in this collection.
     *
     * @since   1.0
     * @access  private
     * @var     Server[]
     */
    private $servers = array();

    /**
     * Constructor. Optionally pass in an array of servers.
     *
     * @since   1.0
     * @access  public
     * @param   Server[] $servers
     * @return  void
     */
    public function __construct(array $servers=array())
    {
        foreach ($servers as $server) {
            $this->addServer($server);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addServer(Server $server)
    {
        $this->servers[] = $server;
    }

    /** Countable *************************************************************/

    public function count()
    {
        return count($this->servers);
    }

    /** IteratorAggregate *****************************************************/

    public function getIterator()
    {
        return new \ArrayIterator($this->servers);
    }
}
