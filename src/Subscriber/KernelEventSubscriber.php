<?php

namespace AristekSystems\TestTask\Subscriber;

use AristekSystems\TestTask\Exception\ValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class KernelEventSubscriber implements EventSubscriberInterface
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationException) {
            $violations = [];
            foreach ($exception->getViolations() as $violation) {
                $violations[$violation->getPropertyPath()] = [
                    'message' => $violation->getMessage()
                ];
            }

            $responseContent = [
                'message' => $exception->getMessage(),
                'violations' => $violations
            ];

            $response = new JsonResponse($responseContent, $exception->getCode());
        } else {
            $responseContent = [
                'message' => $exception->getMessage()
            ];

            $response = new JsonResponse($responseContent, $exception->getCode());
        }

        $event->setResponse($response);
    }

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return ['kernel.exception' => 'onKernelException'];
    }
}