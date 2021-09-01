<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\DocumentTypesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentTypesController extends Controller
{
    private $service;

    public function __construct(DocumentTypesService $service)
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

}
