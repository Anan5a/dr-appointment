<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('super admin') || auth()->user()->id == $this->route('user')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:40', 'min:2'],
            'last_name' => ['required', 'string', 'max:40', 'min:3'],
//            'email' => ['required', 'string', 'email:rfc', 'max:255', 'unique:users'],
            'mobile'=>['required', 'regex:/0\d{10}/i'],
            'date_of_birth'=> ['required', 'date','before:now'],
            'role[]'=>[Rule::in(Role::all()->pluck('id'))]
        ];
    }
}
