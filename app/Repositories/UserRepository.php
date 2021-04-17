<?php

namespace App\Repositories;

use App\Entities\UserEntity;
use App\User;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(UserEntity $userEntity)
    {
        $user = $this->user->create($userEntity->toArray());
        $userEntity->setId($user->id);

        return $userEntity;
    }
    public function find($userId)
    {
        $user = $this->user->findOrFail($userId);
        $userEntity = new UserEntity();
        $userEntity->setId($user->id);
        $userEntity->setName($user->name);
        $userEntity->setEmail($user->email);

        return $userEntity;
    }
    public function update(UserEntity $userEntity)
    {
        $this->user->update($userEntity->toArray());

        return $userEntity;
    }
    public function followingUsers($userId)
    {
        return   $this->user->find($userId)->following()->pluck('following_user_id');
    }
}
