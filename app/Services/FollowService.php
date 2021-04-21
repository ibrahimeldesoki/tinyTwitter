<?php

namespace  App\Services;

use App\Entities\FollowEntity;
use App\Exceptions\CanotFollowYourselfException;
use App\Exceptions\FollowedExistException;
use App\Repositories\FollowRepository;

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
            throw new FollowedExistException();
        } elseif ($followEntity->getFollowerEntity()->getId() == $followEntity->getFollowingEntity()->getId()) {
            throw new CanotFollowYourselfException();
        }

        return $this->followRepository->follow($followEntity);
    }

    public function unFollow(FollowEntity $followEntity)
    {
        if ($followEntity->getFollowerEntity()->getId() == $followEntity->getFollowingEntity()->getId()) {
            return response()->json(['You can not unfollow Yourself']);
        }
        $followExist = $this->followRepository->followed($followEntity);
        if (!$followExist) {
            return response()->json(['You are not following this account']);
        }

        return $this->followRepository->unFollow($followEntity);
    }
}
