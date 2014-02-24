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
 * An adapter factory that creates pheanstalk adapters.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class PheanstalkAdapterFactory implements AdapterFactory
{
    /**
     * {@inheritdoc}
     */
    public function create(Server $server)
    {
        return new PheanstalkAdapter(
            new \Pheanstalk_Pheanstalk($server->getHost(), $server->getPort())
        );
    }
}
