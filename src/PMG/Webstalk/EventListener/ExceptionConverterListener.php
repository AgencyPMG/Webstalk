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
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use PMG\Webstalk\Exception\ServerNotFoundException;

/**
 * Converts ServerNotFoundException to a NotFoundHttpException to play nice with
 * Silex/Symfony.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class ExceptionConverterListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => ['onException', 255], // very early!
        ];
    }

    /**
     * If the event's exception is ServerNotFoundException, this switches it out
     * for an NotFoundHttpException.
     *
     * @since   1.0
     * @access  public
     * @param   GetResponseForExceptionEvent $event
     * @return  void
     */
    public function onException(GetResponseForExceptionEvent $event)
    {
        $except = $event->getException();
        if ($except instanceof ServerNotFoundException) {
            $event->setException(new NotFoundHttpException($except->getMessage(), $except));
        }
    }
}
