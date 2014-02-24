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

use PMG\Webstalk\Exception\AdapterException;
use PMG\Webstalk\Entity\DefaultStatistics;
use PMG\Webstalk\Entity\DefaultTubeList;

/**
 * An adapter that used the Pheanstalk Library.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class PheanstalkAdapter implements Adapter
{
    /**
     * the pheanstalk backend.
     *
     * @since   1.0
     * @access  private
     * @var     Pheanstalk_PheanstalkInterface
     */
    private $conn;

    /**
     * Constructor. Set up the pheanstalk instance.
     *
     * @since   1.0
     * @access  public
     * @param   Pheanstalk_PheanstalkInterface $conn
     * @return  void
     */
    public function __construct(\Pheanstalk_PheanstalkInterface $conn)
    {
        $this->conn = $conn;
    }

    /**
     * {@inheritdoc}
     */
    public function getServerStats()
    {
        try {
            $resp = $this->conn->stats();
        } catch (\Exception $e) {
            throw new AdapterException(
                sprintf('Error fetching server stats: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }

        return new DefaultStatistics($resp->getArrayCopy());
    }

    /**
     * {@inheritdoc}
     */
    public function getTubes()
    {
        try {
            $resp = $this->conn->listTubes();
        } catch (\Exception $e) {
            throw new AdapterException(
                sprintf('Error listing tubes: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }

        $tl = [];
        foreach ($resp as $tube) {
            $tl[$tube] = $this->getTubeStats($tube);
        }

        return new DefaultTubeList($tl);
    }

    /**
     * {@inheritdocs}
     */
    public function getTubeStats($tube_name)
    {
        try {
            $resp = $this->conn->statsTube($tube_name);
        } catch (\Exception $e) {
            throw new AdapterException(
                sprintf('Error fetching tube stats: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }

        return new DefaultStatistics($resp->getArrayCopy());
    }
}
