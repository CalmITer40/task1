<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\HttpNotFoundException;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index()
    {
        $products = $this->productService->list();

        return view('products/index', [
            'products' => ProductResource::collection($products)
        ]);
    }

    /**
     * @param CreateProductRequest $request
     *
     * @return JsonResponse
     */

    public function create(CreateProductRequest $request): JsonResponse
    {
        $requestData = $this->getData($request);
        return $this->responseJsonCreated($this->productService->create($requestData));
    }

    /**
     * @param UpdateProductRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $requestData = $this->getData($request);
        return $this->responseJsonOk($this->productService->update($id, $requestData));
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     * @throws HttpNotFoundException
     */

    public function view(int $id): JsonResponse
    {
        return $this->responseJsonOk($this->productService->view($id));
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */

    public function delete(int $id): JsonResponse
    {
        return $this->responseJsonOk($this->productService->delete($id));
    }
}
