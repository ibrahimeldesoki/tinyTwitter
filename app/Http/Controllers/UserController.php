<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Utils\JWTAppAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
    {
        private $userService;
        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }
        public function authenticate(Request $request, JWTAppAuth $jwtAuth)
        {
            $credentials = $request->only('email', 'password');
            $userEntity = new UserEntity;
            $userEntity->setEmail($request->email);
            $userEntity->setPassword($request->password);
            try {
                if (! $token = $jwtAuth->attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token'));
        }

        public function register(UserRequest $userRequest, JWTAppAuth $jwtAppAuth)
        {
            $userEntity =  new UserEntity ;

            $userEntity->setName($userRequest->name);
            $userEntity->setEmail($userRequest->email);
            $userEntity->setPassword($userRequest->password);
            $userEntity->setDateOfBirth($userRequest->date_of_birth);
            $userEntity->setImage($userRequest->image);

            $user =  $this->userService->register($userEntity);
            $token = $jwtAppAuth->fromUser($user);

            return response()->json(compact('user', 'token'), 201);
        }

        public function getAuthenticatedUser(JWTAppAuth $jwtAppAuth)
        {
            if (! $user = $jwtAppAuth->parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            return response()->json(compact('user'));
        }
    }
