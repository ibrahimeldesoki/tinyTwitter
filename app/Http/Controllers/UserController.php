<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

    class UserController extends Controller
    {
        private $userService;
        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }
        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');
            $userEntity = new UserEntity;
            $userEntity->setEmail($request->email);
            $userEntity->setPassword($request->password);
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token'));
        }

        public function register(UserRequest $userRequest)
        {
            $userEntity =  new UserEntity ;

            $userEntity->setName($userRequest->name);
            $userEntity->setEmail($userRequest->email);
            $userEntity->setPassword($userRequest->password);
            $userEntity->setDateOfBirth($userRequest->date_of_birth);
            $userEntity->setImage($userRequest->image);

            $user =  $this->userService->register($userEntity);
            dd($user);
            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user', 'token'), 201);
        }

        public function getAuthenticatedUser()
        {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            return response()->json(compact('user'));
        }
    }
