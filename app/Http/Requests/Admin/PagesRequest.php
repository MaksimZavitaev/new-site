<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
            'active' => 'boolean',
            'parent_id' => 'required|exists:pages,id',
            'name' => 'required',
            'title' => 'required',
//            'slug' => 'required|slug',
            'seo.title' => 'required',
            'seo.keywords' => 'required',
            'seo.description' => 'required',
            'seo.h1' => 'required',
            'seo.alt' => 'required'
        ];
    }
}
