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

class SadPheanstalkAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $conn, $adapter;

    /**
     * @expectedException PMG\Webstalk\Exception\AdapterException
     */
    public function testServerStats()
    {
        $this->adapter->getServerStats();
    }

    /**
     * @expectedException PMG\Webstalk\Exception\AdapterException
     */
    public function testTubeStats()
    {
        $this->adapter->getTubeStats('default');
    }

    /**
     * @expectedException PMG\Webstalk\Exception\AdapterException
     */
    public function testGetTubes()
    {
        $this->adapter->getTubes();
    }

    protected function setUp()
    {
        $host = getenv('BEANSTALKD_HOST') ?: 'localhost';
        $port = getenv('BEANSTALKD_PORT') ?: 11300;
        // make the connection fail!
        $this->conn = new \Pheanstalk_Pheanstalk($host, $port+1);
        $this->adapter = new PheanstalkAdapter($this->conn);
    }
}
