<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Accounting\SaleConceptsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleConceptsController extends Controller
{
    private $service;

    public function __construct(SaleConceptsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $saleConcepts = $this->service->index($request);
        return response()->json($saleConcepts, Response::HTTP_OK);
    }
}
