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

class DefaultTubeListTest extends \PHPUnit_Framework_TestCase
{
    public function testCountable()
    {
        $s = $this->getMock('PMG\\Webstalk\\Entity\\Statistics');
        $tl = new DefaultTubeList([
            'default'   => $s,
        ]);

        $this->assertCount(1, $tl);
    }

    public function testIteratorAggregate()
    {
        $s = $this->getMock('PMG\\Webstalk\\Entity\\Statistics');
        $tl = new DefaultTubeList([
            'default'   => $s,
        ]);

        $this->assertInstanceOf('Traversable', $tl->getIterator());
        foreach ($tl as $tube => $stats) {
            $this->assertInternalType('string', $tube);
            $this->assertSame($s, $stats);
        }
    }
}
