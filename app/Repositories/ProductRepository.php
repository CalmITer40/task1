<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements Interfaces\ProductRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Product::all();
    }

    /**
     * @param int $id
     * @return object
     */
    public function getById(int $id)
    {
        return Product::find($id);
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int|bool
     */
    public function update(int $id, array $data)
    {
        $product = Product::find($id);

        if ($product) {
            return $product->update($data);
        }

        return false;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return Product::destroy($id);
    }
}
