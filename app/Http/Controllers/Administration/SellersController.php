<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Sellers\StoreSellerRequest;
use App\Http\Requests\Administration\Sellers\UpdateSellerRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\SellersService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellersController extends Controller
{
    private $service;

    public function __construct(SellersService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $sellers = $this->service->index($request);
        return response()->json($sellers, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $sellers = $this->service->paginated($request);
        return response()->json($sellers, Response::HTTP_OK);
    }

    public function store(StoreSellerRequest $request)
    {
        $seller = $this->service->store($request);
        return response()->json($seller, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $seller = $this->service->findById($id);
        return response()->json($seller, Response::HTTP_OK);
    }

    public function update(UpdateSellerRequest $request, $id)
    {
        $seller = $this->service->update($request, $id);
        return response()->json($seller, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $seller = $this->service->restore($id);
        return response()->json($seller, Response::HTTP_OK);
    }
}
