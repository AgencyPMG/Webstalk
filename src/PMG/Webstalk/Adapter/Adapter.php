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

/**
 * Adapters wrap up our interaction with the various beanstalkd client libraries.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface Adapter
{
    /**
     * Get the overall server stats.
     *
     * @since   1.0
     * @access  public
     * @return  Statistics
     */
    public function getServerStats();

    /**
     * Get all available tubes on the server.
     *
     * @since   1.0
     * @access  public
     * @return  TubeList
     */
    public function getTubes();

    /**
     * Get the statistics for a single tube.
     *
     * @since   1.0
     * @access  public
     * @param   string $tube_name
     * @return  Statistics
     */
    public function getTubeStats($tube_name);
}
