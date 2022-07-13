<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\UpdateArticle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => ['required', 'min:10', 'max:255'],
            'article' => [
                'required',
                'alpha_num',
                'max:255',
                'unique:products,article,' . $id,
                new UpdateArticle($id)
            ],
            'status' => ['required', Rule::in(['available', 'unavailable'])]
        ];
    }

    /**
     * @return array
     */

    public function messages()
    {
        return [
            'name.required' => 'Обязательное поле',
            'name.min' => 'Минимум 10 символов',
            'name.max' => 'Максимум 255 символов',
            'article.required' => 'Обязательное поле',
            'article.alpha_num' => 'Только буквы и цифры',
            'article.max' => 'Максимум 255 символов',
            'article.unique' => 'Повторяющееся значение',
            'status.required' => 'Обязательное поле',
            'status.in' => 'Только значения Доступно (available) и Не доступно (unavailable)'
        ];
    }
}
