<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package    App\Models\Website
 */
class Page extends Model
{
    use SoftDeletes;

    /**
     * @var        array
     */
    protected $fillable = [
        "name",
        "slug",
        "keywords",
        "description",
        "viewable",
        "editable",
    ];

    /**
     * Return the content relation
     *
     * @return     \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
    	return $this->hasMany(\App\Models\Website\Content::class);
    }

    /**
     * Return the website relation
     *
     * @return     \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function website()
    {
    	return $this->belongsTo(\App\Models\Website\Website::class);
    }
}
