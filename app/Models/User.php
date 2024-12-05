<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function markEmailAsVerified()
    {
        return true;
    }

    public function hasVerifiedEmail()
    {
        return true;
    }

    protected $fillable = [
        'email',
        'password',
        'type',
        'name',
        'initial',
        'age',
        'sex',
        'years_of_experience',
        'address',
        'education',
        'pr',
        'train_line',
        'station',
        'desired_work',
        'desired_language',
        'desired_place',
        'desired_others',
        'self_analysis',
        'skill_score',
        'desired_price',
        'desired_start',
        'desired_area',
        'desired_remote',
        'skill_business',
        'skill_work',
        'skill_frontend',
        'skill_backend',
        'skill_framework',
        'skill_web_server',
        'skill_middleware',
        'skill_os',
        'skill_database',
        'skill_environment',
        'skill_cloud',
        'skill_infrastructure',
        'skill_tool',
        'skill_design',
        'skill_others',
        'age_group',
        'is_japanese',
        'nationality'
    ];

    protected $casts = [
        'pr' => 'array',
        'desired_work' => 'array',
        'desired_language' => 'array',
        'desired_place' => 'array',
        'desired_others' => 'array',
        'self_analysis' => 'array',
        'skill_score' => 'array',
        'is_japanese' => 'boolean',
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function workExperiences()
    {
        return $this->hasMany(UserWorkExperience::class);
    }
    public function getHasSkillSheetAttribute(): bool
    {
        return !empty($this->name) && $this->workExperiences()->exists();
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
