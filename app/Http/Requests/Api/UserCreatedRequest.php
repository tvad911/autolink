<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserCreatedRequest extends FormRequest
{
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
        $rules = array(
            'username' => 'required|min:6|max:13|unique:acl_users,username',
            'email'    => 'required|min:6|max:255|unique:acl_users,email',
            'password' => 'required|min:6|max:64|confirmed',
            'name'     => 'required|min:3|max:255',
            'group_id' => 'required|integer|exists:acl_groups,id',
            'status'   => 'required|integer',
        );

        return $rules;
    }
}
