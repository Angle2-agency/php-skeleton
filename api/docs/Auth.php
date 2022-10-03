<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     tags={"Authorization"},
 *     operationId="auth.sign-in",
 *     path="/auth/sign-in",
 *     summary="Sign In",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", example="some@email.com"),
 *                 @OA\Property(property="password", type="string", example="somepass"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(ref="#/components/schemas/AuthData")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="UnauthorizedException",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedException")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UnprocessableEntityException",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableEntityException")
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Authorization"},
 *     operationId="auth.sign-in-token",
 *     path="/auth/sign-in-token",
 *     summary="Sign in by token",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="token", type="string", example="sdasdasdadasdasd"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(ref="#/components/schemas/AuthData")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="UnauthorizedException",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedException")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UnprocessableEntityException",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableEntityException")
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Authorization"},
 *     operationId="auth.sign-up",
 *     path="/auth/sign-up",
 *     summary="Sign up",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", example="some@email.com"),
 *                 @OA\Property(property="name", type="string", example="John Smith"),
 *                 @OA\Property(property="password", type="string", example="password"),
 *                 @OA\Property(property="password_confirmation", type="string", example="password"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(ref="#/components/schemas/AuthData")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="UnauthorizedException",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedException")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UnprocessableEntityException",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableEntityException")
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Authorization"},
 *     operationId="auth.forgot-password",
 *     path="/auth/forgot-password",
 *     summary="Set request of password forgot",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", example="some@email.com"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="UnauthorizedException",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedException")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UnprocessableEntityException",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableEntityException")
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Authorization"},
 *     operationId="auth.confirm-email",
 *     path="/auth/confirm-email",
 *     summary="Email confirmation",
 *     @OA\Parameter(
 *          description="Verification token",
 *          in="query",
 *          name="token",
 *          required=true,
 *          example="qweadcasdcacadc"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="UnauthorizedException",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedException")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UnprocessableEntityException",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableEntityException")
 *     )
 * )
 */

/**
 * @OA\Schema(
 *  schema="AuthData",
 *  title="Authorization data",
 *  @OA\Property(property="token", type="string", example="wMWU5OTAiLCJpYXQiOjE2NjE1MTM2NTguMjI3NDk4LCJuYmYiOjE2NjE1MT"),
 *  @OA\Property(property="tokenType", type="string", example="Bearer"),
 * )
 */