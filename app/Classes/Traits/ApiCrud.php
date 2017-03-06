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
trait ApiCrud
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

        if (is_null($entities)) {
            abort(416);
        }

        return response()->json($entities);
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
            return response()->json($entity);
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
        $entity = new $this->entity['model'];

        return $this->save($entity, $request->all());
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
            return $this->save($entity, $request->all());
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

            return response()->json(['deleted'=>true]);
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

        return response()->json(['saved'=>true]);
    }
}