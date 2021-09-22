<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Products\StoreProductRequest;
use App\Http\Requests\Administration\Products\UpdateProductRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\ProductsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    private $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->service->index($request);
        return response()->json($products, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $products = $this->service->paginated($request);
        return response()->json($products, Response::HTTP_OK);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->store($request);
        return response()->json($product, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $product = $this->service->findById($id);
        return response()->json($product, Response::HTTP_OK);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->service->update($request, $id);
        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $product = $this->service->restore($id);
        return response()->json($product, Response::HTTP_OK);
    }
}
