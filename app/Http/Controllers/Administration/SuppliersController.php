<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Administration\Suppliers\UpdateSupplierRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\SuppliersService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuppliersController extends Controller
{
    private $service;

    public function __construct(SuppliersService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $suppliers = $this->service->index($request);
        return response()->json($suppliers, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $suppliers = $this->service->paginated($request);
        return response()->json($suppliers, Response::HTTP_OK);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = $this->service->store($request);
        return response()->json($supplier, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $supplier = $this->service->findById($id);
        return response()->json($supplier, Response::HTTP_OK);
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = $this->service->update($request, $id);
        return response()->json($supplier, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $supplier = $this->service->restore($id);
        return response()->json($supplier, Response::HTTP_OK);
    }
}
