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

class DefaultServerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetHost()
    {
        $s = new DefaultServer('localhost', 11300);
        $this->assertEquals('localhost', $s->getHost());
    }

    public function testGetPort()
    {
        $s = new DefaultServer('localhost', 11300);
        $this->assertEquals(11300, $s->getPort());
    }

    public function testGetDisplayName()
    {
        $s = new DefaultServer('localhost', 11300, 'displayName');
        $this->assertEquals('displayName', $s->getDisplayName());

        // make sure it defaults to host name
        $s = new DefaultServer('localhost', 11300);
        $this->assertEquals('localhost', $s->getDisplayName());
    }
}
