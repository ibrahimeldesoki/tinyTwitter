<?php

namespace  App\Services;

use App\Entities\FollowEntity;
use App\Exceptions\CanotFollowYourselfException;
use App\Exceptions\FollowedExistException;
use App\repositories\FollowRepository;

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
            throw new FollowedExistException;
        } elseif ($followEntity->getFollowerEntity()->getId() == $followEntity->getFollowingEntity()->getId()) {
            throw new CanotFollowYourselfException;
        }

        return $this->followRepository->follow($followEntity);
    }
}
