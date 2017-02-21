<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Website
 * @package    App\Models\Website
 */
class Website extends Model
{
    use SoftDeletes;

    /**
     * @var        array
     */
    protected $fillable = [
        "name",
        "scheme",
        "is_active",
        "multi_login"
    ];

    /**
     * Return the pages relation.
     *
     * @return     \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
    	return $this->hasMany(\App\Models\Website\Page::class);
    }
}
