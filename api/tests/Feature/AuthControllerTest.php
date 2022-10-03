<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;
use Tests\Traits\UserTrait;

class AuthControllerTest extends TestCase
{
    use UserTrait;

    public function testSignIn(): void
    {
        $user = $this->getUser();
        $res = $this->json('POST', 'auth/sign-in', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $res->assertStatus(ResponseAlias::HTTP_OK);
        $res->assertJsonStructure([
            'token',
            'tokenType'
        ]);
    }

    public function testSignInWithWrongData(): void
    {
        $user = $this->getUser();
        $res = $this->json('POST', 'auth/sign-in', [
            'email' => $user->email,
            'password' => 'wrongpass'
        ]);

        $res->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED);
    }

    public function testSignInByToken(): void
    {
        $user = $this->getUser();
        $user = $this->setRememberToken($user);

        $res = $this->json('POST', 'auth/sign-in-token', [
            'token' => $user->remember_token,
        ]);

        $res->assertStatus(ResponseAlias::HTTP_OK);
        $res->assertJsonStructure([
            'token',
            'tokenType'
        ]);
    }

    public function testSignInByTokenWithWrongData(): void
    {
        $user = $this->getUser();

        $res = $this->json('POST', 'auth/sign-in-token', [
            'token' => $user->remember_token,
        ]);

        $res->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testSignUp(): void
    {
        $email = $this->faker->email;
        $name = $this->faker->name;

        $res = $this->json('POST', 'auth/sign-up', [
            'email' => $email,
            'name' => $name,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $res->assertStatus(ResponseAlias::HTTP_OK);
        $res->assertJsonStructure([
            'token',
            'tokenType'
        ]);
    }

    public function testSignUpWithWrongData(): void
    {
        $email = $this->faker->email;
        $name = $this->faker->name;

        $res = $this->json('POST', 'auth/sign-up', [
            'email' => $email,
            'name' => $name,
            'password' => 'password',
            'password_confirmation' => 'wqqweqweqweqwe'
        ]);

        $res->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        $res->assertJson([
            'message' => 'The password confirmation and password must match.',
            'errors' => [
                [
                    'detail' => 'The password confirmation and password must match.',
                    'source' => 'password_confirmation'
                ]
            ]
        ]);
    }

    public function testConfirmEmail(): void
    {
        $user = $this->getUser();
        $user = $this->setConfirmationToken($user);

        $res = $this->json('GET', 'auth/confirm-email', [
            'token' => $user->remember_token,
        ]);

        $res->assertStatus(ResponseAlias::HTTP_OK);
        $res->assertJson([
            'confirmed' => true
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'remember_token' => null
        ]);
    }

    public function testConfirmEmailWithWrongData(): void
    {
        $res = $this->json('GET', 'auth/confirm-email', [
            'token' => 'some_wrong_token',
        ]);

        $res->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testForgotPassword(): void
    {
        $user = $this->getUser();

        $res = $this->json('POST', 'auth/forgot-password', [
            'email' => $user->email,
        ]);

        $res->assertStatus(ResponseAlias::HTTP_OK);
        $res->assertJson([
            'emailSend' => true
        ]);
    }

    public function testForgotPasswordWithWrongData(): void
    {
        $res = $this->json('POST', 'auth/forgot-password', [
            'email' => 'some@wrong.email',
        ]);

        $res->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        $res->assertJson([
            'message' => 'The selected email is invalid.',
            'errors' => [
                [
                    'detail' => 'The selected email is invalid.',
                    'source' => 'email'
                ]
            ]
        ]);
    }
}
