<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\FiscalRolesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FiscalRolesController extends Controller
{
    private $service;

    public function __construct(FiscalRolesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $entities = $this->service->index();
        return response()->json($entities, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $entities = $this->service->paginated($request);
        return response()->json($entities, Response::HTTP_OK);
    }

    public function show($id)
    {
        $entity = $this->service->findById($id);
        return response()->json($entity, Response::HTTP_OK);
    }

}
