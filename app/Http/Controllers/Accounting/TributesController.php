<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\Tributes\StoreTributeRequest;
use App\Http\Requests\Accounting\Tributes\UpdateTributeRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Accounting\TributesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TributesController extends Controller
{
    private $service;

    public function __construct(TributesService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $tributes = $this->service->index($request);
        return response()->json($tributes, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $tributes = $this->service->paginated($request);
        return response()->json($tributes, Response::HTTP_OK);
    }

    public function store(StoreTributeRequest $request)
    {
        $tribute = $this->service->store($request);
        return response()->json($tribute, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $tribute = $this->service->findById($id);
        return response()->json($tribute, Response::HTTP_OK);
    }

    public function update(UpdateTributeRequest $request, $id)
    {
        $tribute = $this->service->update($request, $id);
        return response()->json($tribute, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $tribute = $this->service->restore($id);
        return response()->json($tribute, Response::HTTP_OK);
    }

}
