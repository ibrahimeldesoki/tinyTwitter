<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_reports_is_downloadable()
    {
        $user = factory(User::class)->create();
        factory(Tweet::class ,30)->create(['user_id'=>$user->id]);
        $token= JWTAuth::fromUser($user);

        $this->get('/api/v1/report',['Authorization' => 'Bearer'.$token])
        ->assertStatus(200)
        ->assertHeader('content-type','application/pdf');
    }
}
