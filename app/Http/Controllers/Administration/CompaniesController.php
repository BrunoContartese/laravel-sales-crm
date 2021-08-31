<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\Companies\StoreCompanyRequest;
use App\Http\Requests\Administration\Companies\UpdateCompanyRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\CompaniesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompaniesController extends Controller
{
    private $service;

    public function __construct(CompaniesService $service)
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

    public function show($id)
    {
        $entity = $this->service->findById($id);
        return response()->json($entity, Response::HTTP_OK);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $entity = $this->service->update($request, $id);
        return response()->json($entity, Response::HTTP_OK);
    }
}
