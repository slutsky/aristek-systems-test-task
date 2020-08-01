<?php

namespace AristekSystems\TestTask\Subscriber;

use AristekSystems\TestTask\Exception\BadTokenException;
use AristekSystems\TestTask\Exception\ValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class KernelEventSubscriber implements EventSubscriberInterface
{
    /**
     * @param string
     */
    private $tokenName;

    /**
     * @param string
     */
    private $tokenExpectedValue;

    /**
     * @param string $authorisationTokenValue
     * @param string $authorisationTokenName
     */
    public function __construct(
        string $tokenName,
        string $tokenExpectedValue
    ) {
        $this->tokenName = $tokenName;
        $this->tokenExpectedValue = $tokenExpectedValue;
    }

    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $apiKey = $request->query->get($this->tokenName);

        if (!$apiKey || $apiKey !== $this->tokenExpectedValue) {
            throw new BadTokenException();
        }
    }

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
        return [
            'kernel.request' => 'onKernelRequest',
            'kernel.exception' => 'onKernelException'
        ];
    }
}
