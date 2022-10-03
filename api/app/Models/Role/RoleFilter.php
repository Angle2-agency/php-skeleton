<?php

declare(strict_types=1);

namespace App\Models\Role;

use App\Contract\Core\FilterInterface;
use Illuminate\Http\Request;

/**
 * Class RoleFilter
 */
class RoleFilter implements FilterInterface
{
    private ?string $title = null;
    private ?string $type = null;

    public static function fromRequest(Request $request): FilterInterface
    {
        $filter = new self();
        $filter->setTitle($request->get('title'));
        $filter->setType($request->get('type'));

        return $filter;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param  string|null  $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param  string|null  $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }
}
