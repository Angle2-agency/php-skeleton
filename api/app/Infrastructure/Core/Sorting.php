<?php

namespace App\Infrastructure\Core;

use App\Contract\Core\SortingInterface;
use Illuminate\Http\Request;

/**
 * Class Sorting
 * @package App\Infrastructure\Core
 */
class Sorting implements SortingInterface
{
    /** List of directions */
    /** @type  string  */
    const DIRECTION_ASC = 'asc';
    /** @type  string  */
    const DIRECTION_DESC = 'desc';

    /** @var string $field */
    private string $field;

    /** @var string $direction */
    private string $direction;

    /**
     * Sorting constructor.
     *
     * @param string $field
     * @param string $direction
     */
    public function __construct(string $field = 'id', string $direction = 'desc')
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    /**
     * @param Request $request
     * @return Sorting
     */
    public static function fromRequest(Request $request): Sorting
    {
        return new self(
            $request->get('field', 'id'),
            $request->get('direction', 'desc')
        );
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
}
