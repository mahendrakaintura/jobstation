<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkExperience extends Model
{
    protected $table = 'user_work_experiences';

    protected $fillable = [
        'user_id',
        'branch_id',
        'display_order',
        'project_title',
        'period',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
