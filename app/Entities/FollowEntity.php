<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class FollowEntity implements Arrayable, JsonSerializable
{
    private $id;
    private $followerUser;
    private $followingUser;

    public function toArray()
    {
        $array = [];
        $array['id'] = $this->getId();
        $array['follower_user'] = $this->getFollowerEntity();
        $array['following_user'] = $this->getFollowingEntity();

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFollowingEntity(UserEntity $userEntity)
    {
        $this->followingUser = $userEntity;
    }

    public function getFollowingEntity()
    {
        return  $this->followingUser;
    }

    public function setFollowerEntity(UserEntity $userEntity)
    {
        $this->followerUser = $userEntity;
    }

    public function getFollowerEntity()
    {
        return  $this->followerUser;
    }
}
