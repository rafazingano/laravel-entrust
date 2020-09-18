<?php

namespace ConfrariaWeb\Acl\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class UpdatePermission extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermission('admin.permissions.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique(Config::get('cw_acl.permissions_table'))->ignore($this->route()->parameter('permission')),
                'max:255'
            ],
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        ];
    }
}
