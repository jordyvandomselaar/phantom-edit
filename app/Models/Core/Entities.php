<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entities
 * @package App\Models\Core
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class Entities extends Model
{
    protected $table = "entities";

    protected $fillable = [
        'name',
        'model',
        'views',
        'name_multiple',
        'name_single',
    ];

    /**
     * @param $entity
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public static function getEntity($entity)
    {
        return Entities::where("name", "=", $entity)
            ->orWhere('name_multiple', '=', $entity)
            ->orWhere('name_single', '=', $entity)
            ->firstOrFail();
    }
}
