<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return     \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author     Wouter van Marrum <wouter.van.marrum@concept-core.nl>
     * @param      \Illuminate\Http\Request  $request  The request
     * 
     * @return     \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create($request->all());

        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource depending on the value for the field.
     *
     * @author     Wouter van Marrum <wouter.van.marrum@concept-core.nl>
     * @param      string                    $field       The field
     * @param      int|string                $identifier  The identifier
     *
     * @return     \Illuminate\Http\Response
     */
    public function show($field, $identifier)
    {
        foreach ($this->blacklist() as $checkField) {
            if ($field == $checkField) {
                return response()->json(["error"=>"There was an error while searching"]);
            }
        }

        return User::where($field, '=', $identifier)->firstOrFail();
    }

    /**
     * Update the specified resource in storage
     *
     * @author     Wouter van Marrum <wouter.van.marrum@concept-core.nl>
     * @param      \Illuminate\Http\Request  $request     The request
     * @param      string                    $field       The field
     * @param      string|int                $identifier  The identifier
     *
     * @return     \Illuminate\Http\Response
     */
    public function update(Request $request, $field, $identifier)
    {
        $user = User::where($field, '=', $identifier)->findOrFail();

        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => [
                'required|email|max:255|unique:users',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'min:6|confirmed', 
        ]);

        $user->update($request->all());

        return response()->json(['success'=>true]);
    }

    /**
     * Delete the specified resource from storage.
     * 
     * @author     Wouter van Marrum <wouter.van.marrum@concept-core.nl>
     * @param      string                    $field       The field
     * @param      string|int                $identifier  The identifier
     * 
     * @return     \Illuminate\Http\Response
     */
    public function destroy($field, $identifier)
    {
        User::where($field, '=', $identifier)->findOrFail();
    }

    /**
     * Return a array with blacklisted field
     *
     * @return     array
     */
    protected function blacklist()
    {
        return ["password", "remember_token", "updated_at", "deleted_at"];
    }
}
