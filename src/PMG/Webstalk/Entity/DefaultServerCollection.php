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
class DefaultServerCollection extends \ArrayObject implements ServerCollection
{
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
        $this->offsetSEt($this->getKey($server), $server);
    }

    /**
     * {@inheritdoc}
     */
    public function removeServer(Server $server)
    {
        $key = $this->getKey($server);
        if ($this->offsetExists($key)) {
            $this->offsetUnset($key);
            return true;
        }

        return false;
    }

    private function getKey(Server $server)
    {
        return sprintf('%s:%s', $server->getHost(), $server->getPort());
    }
}
