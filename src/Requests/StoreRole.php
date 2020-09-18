<?php

namespace ConfrariaWeb\Acl\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermission('admin.roles.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:\ConfrariaWeb\Acl\Models\Role,name|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        ];
    }
}
