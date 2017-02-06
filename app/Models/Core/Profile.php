<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'insertion',
        'profile_picture',
    ];
}
