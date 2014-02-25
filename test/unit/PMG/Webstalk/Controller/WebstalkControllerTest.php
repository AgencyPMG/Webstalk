<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Controller;

use PMG\Webstalk\Entity\DefaultTubeList;
use PMG\Webstalk\Entity\DefaultStatistics;
use PMG\Webstalk\Entity\DefaultServer;
use PMG\Webstalk\Entity\DefaultServerCollection;

class WebstalkControllerTest extends \PHPUnit_Framework_TestCase
{
    private $templates, $factory, $conn, $servers, $server, $controller;

    public function testListServersAction()
    {
        $this->factory->expects($this->once())
            ->method('create')
            ->with($this->identicalTo($this->server))
            ->will($this->returnValue($this->conn));

        $this->conn->expects($this->once())
            ->method('getServerStats')
            ->will($this->returnValue(new DefaultStatistics()));

        $this->templates->expects($this->once())
            ->method('render')
            ->with($this->isType('string'), $this->arrayHasKey('servers'))
            ->will($this->returnValue('rendered'));

        $this->assertEquals('rendered', $this->controller->listServersAction());
    }

    public function testServerStatsAction()
    {
        $this->factory->expects($this->once())
            ->method('create')
            ->with($this->identicalTo($this->server))
            ->will($this->returnValue($this->conn));

        $this->conn->expects($this->once())
            ->method('getTubes')
            ->will($this->returnValue(new DefaultTubeList()));

        $this->templates->expects($this->once())
            ->method('render')
            ->with($this->isType('string'), $this->logicalAnd(
                $this->arrayHasKey('tubes'),
                $this->arrayHasKey('server')
            ))
            ->will($this->returnValue('rendered'));

        $this->assertEquals('rendered', $this->controller->listTubesAction('default'));
    }

    protected function setUp()
    {
        $this->templates = $this->getMock('PMG\\Webstalk\\Adapter\\TemplateEngine');
        $this->factory = $this->getMock('PMG\\Webstalk\\Adapter\\AdapterFactory');
        $this->conn = $this->getMock('PMG\\Webstalk\\Adapter\\Adapter');

        // no mocking the value objects
        $this->server = new DefaultServer('localhost', 11300, 'Default');
        $this->servers = new DefaultServerCollection(['default' => $this->server]);

        $this->controller = new WebstalkController(
            $this->templates,
            $this->factory,
            $this->servers
        );
    }
}
