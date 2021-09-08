<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Products\ProductCategories\StoreProductCategoryRequest;
use App\Http\Requests\Administration\Products\ProductCategories\UpdateProductCategoryRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\ProductCategoriesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoriesController extends Controller
{
    private $service;

    public function __construct(ProductCategoriesService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $productCategories = $this->service->index($request);
        return response()->json($productCategories, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $productCategories = $this->service->paginated($request);
        return response()->json($productCategories, Response::HTTP_OK);
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = $this->service->store($request);
        return response()->json($productCategory, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $productCategory = $this->service->findById($id);
        return response()->json($productCategory, Response::HTTP_OK);
    }

    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $productCategory = $this->service->update($request, $id);
        return response()->json($productCategory, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $productCategory = $this->service->restore($id);
        return response()->json($productCategory, Response::HTTP_OK);
    }
}
