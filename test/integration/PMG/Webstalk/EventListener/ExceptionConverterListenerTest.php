<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\EventListener;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcher;
use PMG\Webstalk\Exception\ServerNotFoundException;

class ExceptionConverterListenerTest extends \PHPUnit_Framework_TestCase
{
    private $dispatcher, $kernel, $subscriber;

    public function testAddSubscriber()
    {
        $this->dispatcher->addSubscriber($this->subscriber);
        $this->assertTrue($this->dispatcher->hasListeners(KernelEvents::EXCEPTION));
    }

    /**
     * @depends testAddSubscriber
     */
    public function testOnExceptionWithoutServerNotFoundException()
    {
        $this->dispatcher->addSubscriber($this->subscriber);

        $except = new \RuntimeException('broke');
        $event = new GetResponseForExceptionEvent(
            $this->kernel,
            Request::create('/'),
            HttpKernelInterface::MASTER_REQUEST,
            $except
        );

        $this->dispatcher->dispatch(KernelEvents::EXCEPTION, $event);

        $this->assertSame($except, $event->getException());
    }

    /**
     * @depends testAddSubscriber
     */
    public function testOnExceptionWithServerNotFoundException()
    {
        $this->dispatcher->addSubscriber($this->subscriber);

        $except = new ServerNotFoundException('Server "nope" not found!');
        $event = new GetResponseForExceptionEvent(
            $this->kernel,
            Request::create('/'),
            HttpKernelInterface::MASTER_REQUEST,
            $except
        );

        $this->dispatcher->dispatch(KernelEvents::EXCEPTION, $event);

        $this->assertInstanceOf(
            'Symfony\\Component\\HttpKernel\\Exception\\HttpExceptionInterface',
            $event->getException()
        );
        $this->assertSame($except, $event->getException()->getPrevious());
    }

    protected function setUp()
    {
        $this->dispatcher = new EventDispatcher();
        $this->kernel = new HttpKernel($this->dispatcher, new ControllerResolver());
        $this->subscriber = new ExceptionConverterListener();
    }
}
