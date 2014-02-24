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
 * Default implementation of Server
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class DefaultServer implements Server
{
    /**
     * The host name
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $host;

    /**
     * The host port.
     *
     * @since   1.0
     * @access  private
     * @var     int
     */
    private $port;

    /**
     * The display name of the server.
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $display_name;

    /**
     * Constructor. Set up our values.
     *
     * @since   1.0
     * @access  public
     * @param   string $host
     * @param   int $port
     * @param   string $display_name
     * @return  void
     */
    public function __construct($host, $port, $display_name=null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->display_name = $display_name ?: $host;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * {@inheritdoc}
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }
}
