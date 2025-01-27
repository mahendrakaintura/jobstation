<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'period',
        'working_hours',
        'workplace',
        'display_price',
        'skills',
        'summary',
        'head_count',
        'monthly_working_hours',
        'price',
        'start',
        'area',
        'remote',
        'business',
        'work',
        'frontend',
        'backend',
        'framework',
        'web_server',
        'middleware',
        'os',
        'database',
        'environment',
        'cloud',
        'infrastructure',
        'tool',
        'design',
        'others',
        'age_group',
        'is_only_japanese'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_only_japanese' => 'boolean'
    ];

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function getIsFavoritedAttribute(): bool
    {
        if (!auth()->check()) {
            return false;
        }
        return $this->favoriteUsers()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function favoriteUsers(): HasMany
    {
        return $this->hasMany(UserFavoriteProject::class, 'project_id');
    }
}
