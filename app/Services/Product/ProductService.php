<?php

namespace App\Services\Product;

use App\Http\Exceptions\HttpNotFoundException;
use App\Http\Resources\ProductResource;
use App\Jobs\SendMailAfterCreateProduct;
use App\Repositories\ProductRepository;

class ProductService
{

    /**
     * @var ProductRepository
     */

    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function list()
    {
        return $this->productRepository->all();
    }

    /**
     * @param array $request
     *
     * @return object
     */

    public function create(array $request)
    {
        $product = $this->productRepository->create($request['body']);
        if ($product) {
            SendMailAfterCreateProduct::dispatch();
        }
        return $product;
    }

    /**
     * @param int $id
     * @param array $request
     * @return bool
     */

    public function update(int $id, array $request)
    {
        return $this->productRepository->update($id, $request['body']);
    }

    /**
     * @param int $id
     *
     * @return object
     */

    public function view(int $id)
    {
        return ProductResource::collection($this->productRepository->getById($id));
    }

    /**
     * @param int $id
     *
     * @return int
     */

    public function delete(int $id)
    {
        return $this->productRepository->delete($id);
    }
}
