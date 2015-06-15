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

class PheanstalkAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $conn, $adapter;

    public function testServerStats()
    {
        $this->assertInstanceOf(
            'PMG\\Webstalk\\Entity\\Statistics',
            $this->adapter->getServerStats()
        );
    }

    public function testTubeStats()
    {
        $this->assertInstanceOf(
            'PMG\\Webstalk\\Entity\\Statistics',
            $this->adapter->getTubeStats('default')
        );
    }

    public function testGetTubes()
    {
        $this->assertInstanceOf(
            'PMG\\Webstalk\\Entity\\TubeList',
            $this->adapter->getTubes()
        );
    }

    protected function setUp()
    {
        $host = getenv('BEANSTALKD_HOST') ?: 'localhost';
        $port = getenv('BEANSTALKD_PORT') ?: 11300;
        $this->conn = new \Pheanstalk\Pheanstalk($host, $port);

        if (!$this->conn->getConnection()->isServiceListening()) {
            $this->markTestSkipped(sprintf(
                'Invalid Beanstalkd host (%s) and port (%s)',
                $host,
                $port
            ));
        }

        $this->adapter = new PheanstalkAdapter($this->conn);
    }
}
