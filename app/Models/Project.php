<?php

namespace App\Models;

use App\Helpers\UrlHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project forUser(\App\Models\User $user)
 * @property int $id
 * @property string $git
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereGit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @property-read mixed $href
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUrl($value)
 * @property-write mixed $raw
 * @property int|null $repository_id
 * @property-read \App\Models\Repository $repositories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereRepositoryId($value)
 * @property-read \App\Models\Repository|null $repository
 */
class Project extends Model
{
    protected $fillable = ['url'];

    public function getHrefAttribute()
    {
        return UrlHelpers::getHref($this->url);
    }

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, User $user)
    {
        return $query->whereHas('users', static function ($q) use ($user) {
            $q->where('user_id', '=', $user->id);
        });
    }

    /**
     * Определяет, относится ли данный подкаст к указанному пользователю?
     * @param User $user
     * @return bool
     */
    public function hasUser(User $user): bool
    {
        return $this->users->contains($user);
    }

}
