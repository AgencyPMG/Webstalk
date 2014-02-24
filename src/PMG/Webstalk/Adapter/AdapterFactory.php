<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Adapter;

use PMG\Webstalk\Entity\Server;

/**
 * Responsable for creating adapter from a host name and port.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface AdapterFactory
{
    /**
     * Create a new adapater.
     *
     * @since   1.0
     * @access  public
     * @param   Server $server
     * @return  Adapter
     */
    public function create(Server $server);
}
