<?php

namespace App\Contract\Core;

use App\Infrastructure\Core\Sorting;
use Illuminate\Http\Request;

/**
 * Class SortingInterface
 * @package App\Contract\Core
 */
interface SortingInterface
{
    /**
     * @param Request $request
     * @return Sorting
     */
    public static function fromRequest(Request $request);

    /**
     * @return string
     */
    public function getField(): string;

    /**
     * @param string $field
     */
    public function setField(string $field): void;

    /**
     * @return string
     */
    public function getDirection(): string;

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void;
}
