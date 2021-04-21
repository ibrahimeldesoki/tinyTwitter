<?php

namespace App\Services;

use App\Entities\UserEntity;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserEntity $userEntity)
    {
        $userEntity->setPassword(Hash::make($userEntity->getPassword()));
        if ($userEntity->getImage() != null) {
            $path =  Storage::disk('public')->put('user/image', $userEntity->getImage());
            $userEntity->setImage(url('storage/'.$path));
        }
        else{
            $userEntity->setImage(asset('assets/images/default.png'));
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
            if ($userEntity->getImage() != null) {
                $path =  Storage::disk('public')->put('user/image', $userEntity->getImage());
                $userEntity->setImage(url('storage/'.$path));
            }
            else{
                $userEntity->setImage(url('assets/images/default.png'));
            }
        }

        return $this->userRepository->update($userEntity);
    }

    public function all()
    {
        return   $this->userRepository->all();
    }
}
