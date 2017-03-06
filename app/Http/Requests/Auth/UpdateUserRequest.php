<?php

namespace App\Http\Requests\Auth;

use App\Classes\Traits\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Auth
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class UpdateUserRequest extends FormRequest
{
    use Entity;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setEntity('users');
        $user = $this->entity['model']::where($this->route('field'), '=', $this->route('identifier'))->firstOrFail();

        return [
            'username' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'min:6|confirmed',
        ];
    }
}
