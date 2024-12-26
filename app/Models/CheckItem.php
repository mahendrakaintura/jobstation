<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckItem extends Model
{
    protected $fillable = [
        'check_item_group_id',
        'display_name',
        'bit_number'
    ];

    protected $casts = [
        'check_item_group_id' => 'integer',
        'bit_number' => 'integer'
    ];
}