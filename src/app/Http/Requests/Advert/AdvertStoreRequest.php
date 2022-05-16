<?php

namespace App\Http\Requests\Advert;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdvertStoreRequest extends AdvertBasicRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return parent::rules() + [
            'images' => 'nullable|array|max:3',
            'images.*' => 'mimes:jpg,png,bmp'
        ];

    }
}
