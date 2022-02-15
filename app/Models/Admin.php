<?php

namespace App\Models;

use Database\Factories\AdminFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property int $user_id
 * @property int $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static AdminFactory factory(...$parameters)
 * @method static Builder|Admin newModelQuery()
 * @method static Builder|Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|Admin onlyTrashed()
 * @method static Builder|Admin query()
 * @method static Builder|Admin whereCreatedAt($value)
 * @method static Builder|Admin whereId($value)
 * @method static Builder|Admin whereRole($value)
 * @method static Builder|Admin whereUpdatedAt($value)
 * @method static Builder|Admin whereUserId($value)
 * @mixin Eloquent
 */
class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'user_id'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Return the underlying user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the role for this admin.
     *
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }
}
