<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Auth\ConfirmEmail\ConfirmEmail;
use App\Application\Auth\ForgotPass\ForgotPass;
use App\Application\Auth\SignInByToken\SignInByToken;
use App\Application\Auth\SingIn\SingIn;
use App\Application\Auth\SingUp\SingUp;
use App\Http\Requests\Authentication\ConfirmEmailRequest;
use App\Http\Requests\Authentication\ForgotPasswordRequest;
use App\Http\Requests\Authentication\SignInByTokenRequest;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Requests\Authentication\SignUpRequest;
use App\Http\Resources\SignInResource;
use Illuminate\Http\JsonResponse;

/**
 *
 * Class AuthController
 */
class AuthController extends Controller
{
    /**
     * @param  SignInRequest  $request
     *
     * @return JsonResponse
     */
    public function signIn(SignInRequest $request): JsonResponse
    {
        $token = $this->execute(
            new SingIn(
                $request->get('email'),
                $request->get('password')
            )
        );

        return response()->json(
            new SignInResource([
                'tokenType' => 'Bearer',
                'token' => $token,
            ])
        );
    }

    /**
     * @param  SignInByTokenRequest  $request
     *
     * @return JsonResponse
     */
    public function signInByToken(SignInByTokenRequest $request): JsonResponse
    {
        $token = $this->execute(
            new SignInByToken($request->get('token'))
        );

        return response()->json(
            new SignInResource([
                'tokenType' => 'Bearer',
                'token' => $token,
            ])
        );
    }

    /**
     * @param  SignUpRequest  $request
     *
     * @return JsonResponse
     */
    public function signUp(SignUpRequest $request): JsonResponse
    {
        $token = $this->execute(new SingUp(
            $request->get('email'),
            $request->get('name'),
            $request->get('password')
        ));

        return response()->json(
            new SignInResource([
                'tokenType' => 'Bearer',
                'token' => $token,
            ])
        );
    }

    /**
     * @param  ConfirmEmailRequest  $request
     *
     * @return JsonResponse
     */
    public function confirmEmail(ConfirmEmailRequest $request): JsonResponse
    {
        $res = $this->execute(new ConfirmEmail(
            $request->get('token')
        ));

        return response()->json([
            'confirmed' => $res
        ]);
    }

    /**
     * @param  ForgotPasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $res = $this->execute(new ForgotPass(
            $request->get('email')
        ));

        return response()->json([
            'emailSend' => $res
        ]);
    }
}
