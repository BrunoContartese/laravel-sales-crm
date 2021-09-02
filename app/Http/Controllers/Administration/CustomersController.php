<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Customers\StoreCustomerRequest;
use App\Http\Requests\Administration\Customers\UpdateCustomerRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\CustomersService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    private $service;

    public function __construct(CustomersService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $customers = $this->service->index($request);
        return response()->json($customers, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $customers = $this->service->paginated($request);
        return response()->json($customers, Response::HTTP_OK);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->service->store($request);
        return response()->json($customer, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $customer = $this->service->findById($id);
        return response()->json($customer, Response::HTTP_OK);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->service->update($request, $id);
        return response()->json($customer, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $customer = $this->service->restore($id);
        return response()->json($customer, Response::HTTP_OK);
    }
}
