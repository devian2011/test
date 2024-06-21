<?php

namespace App\Extension\Listeners;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionListener
{
    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $errors = [$event->getThrowable()->getMessage()];
        if($exception instanceof ValidationFailedException || $exception->getPrevious() instanceof ValidationFailedException) {
            $validationException =  $exception instanceof ValidationFailedException ? $exception : $exception->getPrevious();
            if($validationException instanceof ValidationFailedException) {
                $errors = [];
                foreach ($validationException->getViolations() as $violations) {
                    $errors['validation'][] = $violations->getMessage();
                }
            }
        }

        $response = new JsonResponse([
            'errors' => [$errors],
            'data' => [],
        ], 500);

        $event->setResponse($response);
    }
}
