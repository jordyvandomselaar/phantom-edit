<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        "name",
        "scheme",
        "is_active",
        "multi_login"
    ];
}
