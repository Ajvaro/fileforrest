<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileStoreRequest extends FormRequest
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
        return [
            'title' => 'required|between:2,255',
            'overview_short' => 'required|between:2,300',
            'overview' => 'required|between:2,1024',
            'price' => 'required|numeric',
            'uploads' => [
                'required',
                Rule::exists('uploads', 'file_id')->where(function ($query) {
                    $query->where('deleted_at', null);
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'overview_short.required' => 'The short overview field is required.',
            'uploads.exists' => 'You have to upload at least one file.'
        ];
    }
}
