<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LinkUpdatedRequest extends FormRequest
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
            'url'           => 'required|min:6|max:256|unique:link,url',
            '123link'       => 'required|min:6|max:256|unique:link,123link',
            'shorte'        => 'required|min:6|max:256|unique:link,shorte',
            'megaurl'       => 'required|min:6|max:256|unique:link,megaurl',
            'googl_url'     => 'required|min:6|max:256|unique:link,googl_url',
            'bitly_url'     => 'required|min:6|max:256|unique:link,bitly_url',
            'anotedpad_url' => 'required|min:6|max:256|unique:link,anotedpad_url',
            'tiny_url'      => 'required|min:6|max:256|unique:link,tiny_url',
            'source'        => 'nullable|string|min:6|max:1024',
            'destination'   => 'nullable|string|min:6|max:1024',
            'user_id'       => 'required|integer|exists:acl_users,id',
            'status'        => 'required|integer',
        );

        $input = Request::only('id');

        if($input['id']) {
            $rules['url']           .= ','. $input['id'] .',id';
            $rules['123link']       .= ','. $input['id'] .',id';
            $rules['shorte']        .= ','. $input['id'] .',id';
            $rules['megaurl']       .= ','. $input['id'] .',id';
            $rules['googl_url']     .= ','. $input['id'] .',id';
            $rules['bitly_url']     .= ','. $input['id'] .',id';
            $rules['anotedpad_url'] .= ','. $input['id'] .',id';
            $rules['tiny_url']      .= ','. $input['id'] .',id';
        }

        return $rules;
    }
}