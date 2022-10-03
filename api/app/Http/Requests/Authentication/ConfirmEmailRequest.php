<?php

declare(strict_types=1);

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ConfirmEmailRequest
 */
class ConfirmEmailRequest extends FormRequest
{
    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'token' => 'required|string',
        ];
    }
}
