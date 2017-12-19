<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'name' => 'required|max:255|unique:games,name'.($this->id ? ",$this->id" : ''),
            'nickname' => 'required|max:5|unique:games,nickname'.($this->id ? ",$this->id" : ''),
            'description' => 'required',
            'release_year' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }
}
