<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedApiShortestUrlRequest extends FormRequest
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
            'api_123link'   => 'nullable|string|max:1024',
            'api_shortes'   => 'nullable|string|max:1024',
            'api_megaurl'   => 'nullable|string|max:1024',
            'api_bitly'     => 'nullable|string|max:1024',
            'api_googl'     => 'nullable|string|max:1024',
            'api_anotedpad' => 'nullable|string|max:1024',
            'api_tiny'      => 'nullable|string|max:1024',
            'api_default'   => 'nullable|integer'
        );

        return $rules;
    }
}
