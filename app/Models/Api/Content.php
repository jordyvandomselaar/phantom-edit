<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models\Api
 */
class Content extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        "name",
        "content",
        "position",
        "editable",
        "viewable",
    ];
}
