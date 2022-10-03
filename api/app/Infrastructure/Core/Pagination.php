<?php

namespace App\Infrastructure\Core;

use App\Contract\Core\PaginationInterface;
use Illuminate\Http\Request;

/**
 * Class Pagination
 * @package App\Infrastructure\Core
 */
class Pagination implements PaginationInterface
{
    /** @var int $page */
    private int $page;

    /** @var int $perPage */
    private int $perPage;

    /**
     * Pagination constructor.
     *
     * @param int $page
     * @param int $perPage
     */
    public function __construct(int $page = 1, int $perPage = 10)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    /**
     * @param Request $request
     * @return Pagination
     */
    public static function fromRequest(Request $request): Pagination
    {
        return new self(
            $request->get('page', 1),
            $request->get('perPage', 20)
        );
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }
}
