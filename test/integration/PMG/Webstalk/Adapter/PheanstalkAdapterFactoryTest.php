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

class PheanstalkAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $serv = $this->getMock('PMG\\Webstalk\\Entity\\Server');
        $serv->expects($this->once())
            ->method('getHost')
            ->will($this->returnValue('localhost'));
        $serv->expects($this->once())
            ->method('getPort')
            ->will($this->returnValue(11300));

        $factory = new PheanstalkAdapterFactory();

        $this->assertInstanceOf('PMG\\Webstalk\\Adapter\\Adapter', $factory->create($serv));
    }
}
