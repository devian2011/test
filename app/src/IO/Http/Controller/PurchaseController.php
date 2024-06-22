<?php

namespace App\IO\Http\Controller;

use App\UseCase\UseCaseException;
use App\IO\Http\Request\PurchaseRequest;
use Psr\Log\LoggerInterface;
use App\Service\ServiceException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use App\UseCase\Purchase\PurchaseServiceInterface;

class PurchaseController extends AbstractController
{

    public function __construct(
        private readonly PurchaseServiceInterface $service,
        private readonly LoggerInterface          $logger
    )
    {

    }

    #[Route(path: "/purchase", methods: ['POST'])]
    public function purchase(#[MapRequestPayload] PurchaseRequest $data): JsonResponse
    {
        try {
            $result = $this->service->process($data);
            return $this->json([
                'errors' => null,
                'data' => [
                    'order_id' => $result->getPurchaseId(),
                    'payed' => $result->getPayed(),
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
            return $this->json([
                'errors' => [
                    'Internal server error'
                ],
                'data' => [],
            ], 500);
        }
    }
}
