<?php

namespace App\Http\Controllers\Api;

use App\Classes\Traits\ApiCrud;
use App\Classes\Traits\Entity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class AuthController extends Controller
{
    use Entity;
    use ApiCrud;

    protected $auth;

    /**
     * AuthController constructor.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
        $this->setEntity('users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(RegisterRequest $request)
    {
        $user = $this->entity['model']::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $this->auth->attempt($request->only('email', 'password'));

        return response()->json([
            'data' => $user,
            'token' => $token
        ]);
    }

    /**
     * Display the specified resource depending on the value for the field.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @param $field
     * @param $identifier
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($field, $identifier)
    {
        foreach ($this->blacklist() as $checkField) {
            if ($field == $checkField) {
                return response()->json(["error"=>"There was an error while searching"]);
            }
        }

        return $this->entity['model']::where($field, '=', $identifier)->firstOrFail();
    }

    /**
     * Update the specified resource in storage
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @param UpdateUserRequest $request
     * @param $field
     * @param $identifier
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(UpdateUserRequest $request, $field, $identifier)
    {
        $user = $this->entity['model']::where($field, '=', $identifier)->firstOrFail();
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $this->auth->attempt($request->only('email', 'password'));

        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return array
     */
    protected function blacklist()
    {
        return ["password", "remember_token", "updated_at", "deleted_at"];
    }
}
