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

class TwigTemplateEngineTest extends \PHPUnit_Framework_TestCase
{
    private $twig, $engine;

    public function testRender()
    {
        $this->assertEquals('Hello, Webstalk!', $this->engine->render('Hello, {{ name }}!', array(
            'name'  => 'Webstalk',
        )));
    }

    /**
     * @expectedException PMG\Webstalk\Exception\TemplateException
     */
    public function testRenderWithException()
    {
        $this->engine->render('Hello, {{ name }}!');
    }

    protected function setUp()
    {
        $this->twig = new \Twig_Environment(new \Twig_Loader_String(), [
            'strict_variables'  => true,
        ]);
        $this->engine = new TwigTemplateEngine($this->twig);
    }
}
