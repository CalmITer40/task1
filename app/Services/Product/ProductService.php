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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function list()
    {
        return ProductResource::collection($this->productRepository->all());
    }

    /**
     * @param array $request
     *
     * @return ProductResource|false
     */

    public function create(array $request)
    {
        $product = $this->productRepository->create($request['body']);
        if ($product) {
            SendMailAfterCreateProduct::dispatch();
            return new ProductResource($product);
        }

        return false;
    }

    /**
     * @param int $id
     * @param array $request
     * @return int
     */

    public function update(int $id, array $request)
    {
        return $this->productRepository->update($id, $request['body']);
    }

    /**
     * @param int $id
     *
     * @return ProductResource|bool
     */

    public function view(int $id)
    {
        $product = $this->productRepository->getById($id);
        if ($product) {
            return new ProductResource($product);
        } else {
            return false;
        }
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
