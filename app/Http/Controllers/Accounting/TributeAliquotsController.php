<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\Tributes\StoreTributeAliquotRequest;
use App\Http\Requests\Accounting\Tributes\UpdateTributeAliquotRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Accounting\TributeAliquotsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TributeAliquotsController extends Controller
{
    private $service;

    public function __construct(TributeAliquotsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $tributeAliquots = $this->service->index($request);
        return response()->json($tributeAliquots, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $tributeAliquots = $this->service->paginated($request);
        return response()->json($tributeAliquots, Response::HTTP_OK);
    }

    public function store(StoreTributeAliquotRequest $request)
    {
        $tributeAliquot = $this->service->store($request);
        return response()->json($tributeAliquot, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $tributeAliquot = $this->service->findById($id);
        return response()->json($tributeAliquot, Response::HTTP_OK);
    }

    public function update(UpdateTributeAliquotRequest $request, $id)
    {
        $tributeAliquot = $this->service->update($request, $id);
        return response()->json($tributeAliquot, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $tributeAliquot = $this->service->restore($id);
        return response()->json($tributeAliquot, Response::HTTP_OK);
    }
}
