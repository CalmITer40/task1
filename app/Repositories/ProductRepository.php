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
     * @return mixed
     */
    public function getById(int $id)
    {
        return Product::where('id', $id)->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
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
