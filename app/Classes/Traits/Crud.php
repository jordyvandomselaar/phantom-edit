<?php

namespace App\Classes\Traits;

use View;
use Request;
use Redirect;

/**
 * Class Crud
 * @package App\Classes\Traits
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
trait Crud
{
    /**
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public function index()
    {
        $entities = $this->entity['model']::all();

        return View::make($this->entity->views.".index")->withCore($this->entity)->withEntities($entities);
    }

    /**
     * @param $id
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public function get($id)
    {
        $entity = $this->entity["model"]::find($id);

        if (!is_null($entity)) {
            return View::make($this->entity['views'].".details")->withCore($this->entity)->withEntity($entity);
        }

        abort(404);
    }

    /**
     * @param Request $request
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public function post(Request $request)
    {
        $entity = new $this->entity->model;

        return $this->save($entity, $request);
    }

    /**
     * @param Request $request
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    public function put(Request $request)
    {
        $entity = $this->entity['model']::find(Request::get("id"));

        if (!is_null($entity)) {
            return $this->save($entity, $request);
        }

        abort(500);
    }

    /**
     * @param Request $request
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    protected function delete(Request $request)
    {
        $entity = $this->entity['model']::find(Request::get("id"));

        if (!is_null($entity)) {
            $entity->destroy($entity->id);

            return Redirect::back()->withSuccess("deleted");
        }

        abort(500);
    }

    /**
     * @param $entity
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return mixed
     */
    protected function save($entity)
    {
        $entity->fill(Request::all());
        $entity->save();

        return Redirect::back()->withSuccess('entity saved');
    }
}