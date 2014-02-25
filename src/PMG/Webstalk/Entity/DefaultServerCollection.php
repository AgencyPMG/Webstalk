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

use PMG\Webstalk\Exception\ServerNotFoundException;

/**
 * Default implementation of ServerCollection
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class DefaultServerCollection implements ServerCollection
{
    /**
     * The internal storage.
     *
     * @since   1.0
     * @access  private
     * @var     array
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
        foreach ($servers as $key => $server) {
            $this->addServer($key, $server);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addServer($slug, Server $server)
    {
        $this->servers[$slug] = $server;
    }

    /**
     * {@inheritdoc}
     */
    public function getServer($slug)
    {
        if (!$this->hasServer($slug)) {
            throw new ServerNotFoundException(sprintf('Server "%s" does not exist', $slug));
        }

        return $this->servers[$slug];
    }

    /**
     * {@inheritdoc}
     */
    public function removeServer($slug)
    {
        if ($this->hasServer($slug)) {
            unset($this->servers[$slug]);
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasServer($slug)
    {
        return isset($this->servers[$slug]);
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
