<?php

namespace App\Contract\Core;

use App\Infrastructure\Core\Pagination;
use Illuminate\Http\Request;

/**
 * Interface PaginationInterface
 * @package App\Contract\Core
 */
interface PaginationInterface
{
    /**
     * @param Request $request
     * @return Pagination
     */
    public static function fromRequest(Request $request);

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @return int
     */
    public function getPerPage(): int;
}
