<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Services\ReportService;
use App\Services\TweetService;
use App\Services\UserService;
use App\Utils\JWTAppAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Barryvdh\DomPDF\Facade as PDF;
class UserController extends Controller
{
     private $userService;
    private $reportService;
    public function __construct(UserService $userService , ReportService $reportService)
    {
        $this->userService = $userService;
        $this->reportService  = $reportService ;
    }
    public function authenticate(Request $request, JWTAppAuth $jwtAuth)
    {
        $credentials = $request->only('email', 'password');

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
    public function update(UpdateUserRequest $updateUserRequest)
    {
        $userEntity = $this->userService->find(Auth::user()->id);

        $userEntity->setName($updateUserRequest->name);
        $userEntity->setEmail($updateUserRequest->email);
        $userEntity->setPassword($updateUserRequest->password);
        $userEntity->setDateOfBirth($updateUserRequest->date_of_birth);
        $userEntity->setImage($updateUserRequest->image);

        return $this->userService->update($userEntity);
    }
    public function report()
    {
        $users = $this->reportService->report();
        view()->share('users',$users);
        $pdf = PDF::loadView('pdf', $users);

        return $pdf->download('user_report.pdf');
    }
}
