<?php

namespace ConfrariaWeb\Acl\Requests;

use Auth;
use ConfrariaWeb\Acl\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class UpdateRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Role::find($this->route()->parameter('role'));
        $accountUser = existsAccount()? (Auth::user()->account_id === $role->account_id) : true;
        return Auth::user()->hasPermission('admin.roles.edit') && $accountUser;
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
                Rule::unique(Config::get('cw_acl.roles_table'))->ignore($this->route()->parameter('role')),
                'max:255'
            ],
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        ];
    }
}
