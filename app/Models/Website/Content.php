<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models\Website
 */
class Content extends Model
{
    use SoftDeletes;

    /**
     * @var        array
     */
    protected $fillable = [
        "name",
        "content",
        "position",
        "editable",
        "viewable",
    ];

    /**
     * Return the page relation
     *
     * @return     \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
    	return $this->belongsTo(\App\Models\Website\Page::class);
    }
}
