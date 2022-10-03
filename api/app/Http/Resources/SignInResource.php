<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SignInResource
 * @package App\Http\Resources\Auth
 */
class SignInResource extends JsonResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tokenType' => $this['tokenType'],
            'token' => $this['token'],
        ];
    }
}
