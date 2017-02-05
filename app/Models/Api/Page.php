<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        "name",
        "slug",
        "keywords",
        "description",
        "viewable",
        "editable",
    ]
}
