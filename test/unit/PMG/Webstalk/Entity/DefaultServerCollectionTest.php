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

class DefaultServerCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCount()
    {
        $m = $this->getMock('PMG\\Webstalk\\Entity\\Server');

        $col = new DefaultServerCollection([$m]);

        $this->assertCount(1, $col);
    }

    public function testGetIterator()
    {
        $m = $this->getMock('PMG\\Webstalk\\Entity\\Server');

        $col = new DefaultServerCollection([$m]);

        $this->assertInstanceOf('Traversable', $col->getIterator());

        foreach ($col as $server) {
            $this->assertSame($m, $server);
        }
    }
}
