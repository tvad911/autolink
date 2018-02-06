<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedProfileRequest extends FormRequest
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
            'username' => 'nullable|min:6|max:13|unique:acl_users,username',
            'name'     => 'nullable|min:3|max:255',
        );

        $user_id = \Auth::guard('api')->user()->id;

        if($user_id) {
            $rules['username'] .= ','. $user_id .',id';
        }

        return $rules;
    }
}
