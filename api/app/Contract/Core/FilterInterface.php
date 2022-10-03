<?php

namespace App\Contract\Core;

use Illuminate\Http\Request;

/**
 * Interface FilterInterface
 * @package App\Contract\Core
 */
interface FilterInterface
{
    /**
     * @param Request $request
     * @return static
     */
    public static function fromRequest(Request $request): FilterInterface;
}
