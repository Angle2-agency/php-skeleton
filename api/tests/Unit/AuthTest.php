<?php

namespace Tests\Unit;

use App\Application\Auth\ForgotPass\ForgotPass;
use App\Application\Auth\SignInByToken\SignInByToken;
use App\Application\Auth\SingIn\SingIn;
use App\Application\Auth\SingUp\SingUp;
use App\Models\User\User;
use Illuminate\Validation\UnauthorizedException;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testSingIn(): void
    {
        $user = $this->getUser();
        $res = $this->execute(new SingIn($user->email, 'password'));

        $this->assertIsString($res);
    }

    public function testSingInWrongData(): void
    {
        $user = $this->getUser();
        $this->expectException(UnauthorizedException::class);
        $this->execute(new SingIn($user->email, 'qwqweqweqwe'));
    }

    public function testSingUp(): void
    {
        $email = $this->faker->email;
        $name =  $this->faker->name;

        $res = $this->execute(new SingUp(
            $email, $name, 'testpass', 'testpass'
        ));

        $this->assertIsString($res);
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => $name
        ]);
    }

    public function testSignInByToken(): void
    {
        $user = $this->getUser();
        $this->execute(new ForgotPass($user->email));
        /** @var User $user */
        $user = User::query()->find($user->id);

        $res = $this->execute(new SignInByToken($user->remember_token));
        $this->assertIsString($res);
    }
}
