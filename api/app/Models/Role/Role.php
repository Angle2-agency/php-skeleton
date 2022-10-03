<?php

declare(strict_types=1);

namespace App\Models\Role;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Role
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Role extends Model
{
    use HasFactory;

    /** List of roles */
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @param  string  $roleType
     *
     * @return bool
     */
    public static function isAdmin(string $roleType): bool
    {
        return $roleType === self::ROLE_ADMIN;
    }

    /**
     * @param  string  $roleType
     *
     * @return bool
     */
    public static function isUser(string $roleType): bool
    {
        return $roleType === self::ROLE_USER;
    }
}
