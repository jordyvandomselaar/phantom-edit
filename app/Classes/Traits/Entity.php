<?php

namespace App\Classes\Traits;

use App\Models\Core\Entities;

/**
 * Class Entity
 * @package App\Classes\Traits
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
trait Entity
{
    protected $entity;

    /**
     * @param $entity
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public function setEntity($entity)
    {
        $this->entity = Entities::where("name", "=", $entity)
            ->orWhere('name_multiple', '=', $entity)
            ->orWhere('name_single', '=', $entity)
            ->firstOrFail();

        return $this->entity;
    }
}