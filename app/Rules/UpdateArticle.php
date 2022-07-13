<?php

namespace App\Rules;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateArticle implements Rule
{
    private int $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::find($this->id);

        if (Auth::user()->role == config('products.role') || ($product && $product->article === $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы не можете редактировать это поле';
    }
}
