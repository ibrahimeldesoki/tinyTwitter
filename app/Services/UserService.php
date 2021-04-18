<?php

namespace App\Services;

use App\Entities\UserEntity;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->userRepository = $UserRepository;
    }

    public function register(UserEntity $userEntity)
    {
        $userEntity->setPassword(Hash::make($userEntity->getPassword()));
        if ($userEntity->getImage() != null) {
            $imageName = time().'.'.$userEntity->getImage()->getClientOriginalExtension();
            $destinationPath = 'upload/user/images';
            $imagePath = $destinationPath.'/'.$imageName;
            $userEntity->getImage()->move(public_path($destinationPath), $imageName);
            $userEntity->setImage($imagePath);
        }
        return $this->userRepository->register($userEntity);
    }

    public function find($user_id)
    {
        return $this->userRepository->find($user_id);
    }
    public function update(UserEntity $userEntity)
    {
        $userEntity->setPassword(Hash::make($userEntity->getPassword()));
        if ($userEntity->getImage() != null) {
            $imageName = time().'.'.$userEntity->getImage()->getClientOriginalExtension();
            $destinationPath = 'upload/user/images';
            $imagePath = $destinationPath.'/'.$imageName;
            $userEntity->getImage()->move(public_path($destinationPath), $imageName);
            $userEntity->setImage($imagePath);
        }
        return $this->userRepository->update($userEntity);
    }
    // public function followingUsers($userId)
    // {
    //     return $this->userRepository->followingUsers($userId);
    // }
    public function all()
    {
        return   $this->userRepository->all();
    }
}
