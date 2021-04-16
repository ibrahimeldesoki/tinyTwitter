<?php

namespace  App\Services;

use App\Entities\FollowEntity;
use App\repositories\FollowRepository;
use Exception;

class FollowService
{
    private $followRepository;

    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function follow(FollowEntity $followEntity)
    {
        $followExist = $this->followRepository->followed($followEntity);
        if ($followExist) {
            throw new Exception('You already follow this user');
        } elseif ($followEntity->getFollowerEntity()->getId() == $followEntity->getFollowingEntity()->getId()) {
            throw new Exception('You can not follow yourself');
        }

        return $this->followRepository->follow($followEntity);
    }
}
