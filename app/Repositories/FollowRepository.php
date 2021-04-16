<?php

namespace App\Repositories;

use App\Entities\FollowEntity;
use App\Follow;

class FollowRepository
{
    private $follow;
    private $userRepository;

    public function __construct(Follow $follow, UserRepository $userRepository)
    {
        $this->follow = $follow;
        $this->userRepository = $userRepository;
    }

    public function follow(FollowEntity $followEntity)
    {
        $attributes = [];
        $attributes['follower_user_id'] = $followEntity->getFollowerEntity()->getId();
        $attributes['following_user_id'] = $followEntity->getFollowingEntity()->getId();
        $follow = $this->follow->create($attributes);
        $followEntity->setId($follow->id);

        return $followEntity;
    }

    public function find($follow_id)
    {
        $follow = $this->follow->find($follow_id);
        $followEntity = new FollowEntity();
        $followEntity->setId($follow->id);
        $followEntity->setFollowerEntity($this->userRepository->find($follow->follower_user_id));
        $followEntity->setFollowingEntity($this->userRepository->find($follow->following_user_id));

        return $followEntity;
    }

    public function followed(FollowEntity $followEntity)
    {
        return $this->follow
        ->where('follower_user_id', $followEntity->getFollowerEntity()->getId())
        ->where('following_user_id', $followEntity->getFollowingEntity()->getId())
        ->exists();
    }
}
