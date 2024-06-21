<?php

namespace App\UseCase\Good;

use App\Contracts\Entity\GoodInterface;
use App\Contracts\Repository\GoodRepositoryInterface;

class GoodFinder implements GoodFinderInterface
{

    /**
     * @param GoodRepositoryInterface $goodRepository
     */
    public function __construct(
        private readonly GoodRepositoryInterface $goodRepository)
    {
    }

    public function findById(int $id): GoodInterface
    {
        $good = $this->goodRepository->findById($id);
        if(empty($good)) {
            throw new UnknownGoodException("unknown good with id: " . $id);
        }

        return $good;
    }
}
