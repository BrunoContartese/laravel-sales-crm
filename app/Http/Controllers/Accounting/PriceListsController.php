<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Accounting\PriceListsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListsController extends Controller
{
    private $service;

    public function __construct(PriceListsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $priceLists = $this->service->index($request);
        return response()->json($priceLists, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $priceLists = $this->service->paginated($request);
        return response()->json($priceLists, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $priceList = $this->service->store($request);
        return response()->json($priceList, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $priceList = $this->service->findById($id);
        return response()->json($priceList, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $priceList = $this->service->update($request, $id);
        return response()->json($priceList, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $priceList = $this->service->restore($id);
        return response()->json($priceList, Response::HTTP_OK);
    }
}
