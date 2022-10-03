<?php

use OpenApi\Annotations as OA;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Info(
 *    title="documentation",
 *    version="1.0.0",
 * )
 * @OA\PathItem(path="/")
 */

/**
 * @OA\Schema(
 *  schema="UnprocessableEntityException",
 *  title="Unprocessable entity error",
 * 	@OA\Property(property="message", type="string", example="Validation exception"),
 * 	@OA\Property(property="errors", type="array",
 *     @OA\Items(
 *      @OA\Property(property="detail", type="string", example="Field name is required"),
 *      @OA\Property(property="source", type="string", example="name"),
 *     )
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *  schema="NotFoundHttpException",
 *  title="Not Found error",
 * 	@OA\Property(property="status", type="string", example="404"),
 * 	@OA\Property(property="message", type="string", example="Resource not found"),
 * )
 */

/**
 * @OA\Schema(
 *  schema="EmptyResponse",
 *  title="Empty success response",
 * 	@OA\Property(property="status", type="string", example="204"),
 * )
 */

/**
 * @OA\Schema(
 *  schema="UnauthorizedException",
 *  title="Unauthorized error",
 * 	@OA\Property(property="status", type="string", example="401"),
 * 	@OA\Property(property="message", type="string", example="Unauthorized"),
 * )
 */

/**
 * @OA\Schema(
 *  schema="Redirect",
 *  title="Redirect response",
 * )
 */