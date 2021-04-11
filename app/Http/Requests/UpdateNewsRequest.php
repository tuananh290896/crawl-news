<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'image_url' => 'required_without:old_image_url|image|max:10000',
            'category_id' => 'required',
        ];
    }

    public function getData()
    {
        return $this->only(['title', 'description', 'detail', 'link', 'source', 'category_id']);
    }
}
