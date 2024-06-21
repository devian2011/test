<?php

namespace App\IO\Http\Controller;

use App\UseCase\Good\PriceCalculationInterface;
use App\UseCase\UseCaseException;
use IO\Http\Request\PriceCalculationRequest;
use Psr\Log\LoggerInterface;
use App\Service\ServiceException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PriceController extends AbstractController
{

    public function __construct(
        private readonly PriceCalculationInterface $calculation,
        private readonly ValidatorInterface        $validator,
        private readonly LoggerInterface           $logger
    )
    {
    }

    #[Route(path: '/calculate-price', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] PriceCalculationRequest $data): JsonResponse
    {
        try {
            return $this->json([
                'errors' => null,
                'data' => [
                    'price' => $this->calculation->calculate($data)
                ]
            ]);
        } catch (ServiceException|UseCaseException $exception) {
            $this->logger->error('Error on price calculation: ' . $exception->getMessage());
            return $this->json([
                'errors' => [
                    $exception->getMessage()
                ],
                'data' => [],
            ], 500);
        } catch (\Throwable $throwable) {
            $this->logger->critical('Error on price calculation: ' . $throwable->getMessage());
            var_dump($throwable->getMessage());
            die();
            return $this->json([
                'errors' => [
                    'Internal server error'
                ],
                'data' => [],
            ], 500);
        }
    }
}
