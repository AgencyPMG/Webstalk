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
 * A value object representing a single server.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface Server
{
    /**
     * Get the host name of the server.
     *
     * @since   1.0
     * @access  public
     * @return  string
     */
    public function getHost();

    /**
     * Get the port of the server.
     *
     * @since   1.0
     * @access  public
     * @return  int
     */
    public function getPort();

    /**
     * Get the display name of the server.
     *
     * @since   1.0
     * @access  public
     * @return  string
     */
    public function getDisplayName();
}
