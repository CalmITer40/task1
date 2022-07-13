<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:10',
            'article' => 'required|alpha_num|unique:App\Models\Product'
        ];

        if ($this->isMethod('put')) {
            $id = $this->route('id');
            $rules['article'] = $rules['article'] . ",article," . $id;
        }

        return $rules;
    }

    /**
     * @return array
     */

    public function messages()
    {
        return [
            'name.required' => 'Обязательное поле',
            'name.min' => 'Минимум 10 символов',
            'article.required' => 'Обязательное поле',
            'article.alpha_num' => 'Только буквы и цифры',
            'article.unique' => 'Повторяющееся значение'
        ];
    }
}
