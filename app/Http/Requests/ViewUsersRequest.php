<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class ViewUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->guest() && !auth()->user()->hasRole(['', 'patient']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'result_type[]' => [Rule::in(array_merge(Role::all()->pluck('id')->toArray(), ['all']))],
            'sort_order' => [Rule::in('asc', 'desc')],
            'order_by' => [Rule::in(['id','first_name','last_name'])],
            'query' => 'max:15|min:4|not_regex:/\%/',
            'per_page' => 'number|max:200|min:25'
        ];
    }
    public function prepareForValidation()
    {
        if (!is_array($this->query('result_type'))){
            $this->merge(['result_type'=>0]);
        }

    }
}
