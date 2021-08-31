<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\BranchOffices\StoreBranchOfficeRequest;
use App\Http\Requests\Administration\BranchOffices\UpdateBranchOfficeRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\BranchOfficesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BranchOfficesController extends Controller
{
    private $service;

    public function __construct(BranchOfficesService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $entities = $this->service->index($request);
        return response()->json($entities, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $entities = $this->service->paginated($request);
        return response()->json($entities, Response::HTTP_OK);
    }

    public function store(StoreBranchOfficeRequest $request)
    {
        $entity = $this->service->store($request);
        return response()->json($entity, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $entity = $this->service->findById($id);
        return response()->json($entity, Response::HTTP_OK);
    }

    public function update(UpdateBranchOfficeRequest $request, $id)
    {
        $entity = $this->service->update($request, $id);
        return response()->json($entity, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $entity = $this->service->restore($id);
        return response()->json($entity, Response::HTTP_OK);
    }
}
