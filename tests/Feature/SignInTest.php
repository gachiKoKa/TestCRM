<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    public function testSignIn()
    {
        $user = factory(User::class)->create();
        $response = $this->post('api/sign-in-user', ['email' => $user->email, 'password' => '12345678']);
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->content();
        $this->assertJson($data);
        $arrayData = json_decode($data, true);
        $this->assertArrayHasKey('user', $arrayData);
        $this->assertArrayHasKey('roles', $arrayData);
        $this->assertArrayHasKey('isAdmin', $arrayData);
        $this->assertArrayHasKey('isEmployee', $arrayData);
        $this->assertArrayHasKey('token', $arrayData);
    }

    public function testSignInWithInvalidEmail()
    {
        $response = $this->post('api/sign-in-user', ['email' => '123', 'password' => '12345678']);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
