<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\DeliveryZones\StoreDeliveryZoneRequest;
use App\Http\Requests\Administration\DeliveryZones\UpdateDeliveryZoneRequest;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Services\Administration\DeliveryZonesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryZonesController extends Controller
{
    private $service;

    public function __construct(DeliveryZonesService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $deliveryZones = $this->service->index($request);
        return response()->json($deliveryZones, Response::HTTP_OK);
    }

    public function paginated(PaginatorRequest $request)
    {
        $deliveryZones = $this->service->paginated($request);
        return response()->json($deliveryZones, Response::HTTP_OK);
    }

    public function store(StoreDeliveryZoneRequest $request)
    {
        $deliveryZone = $this->service->store($request);
        return response()->json($deliveryZone, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $deliveryZone = $this->service->findById($id);
        return response()->json($deliveryZone, Response::HTTP_OK);
    }

    public function update(UpdateDeliveryZoneRequest $request, $id)
    {
        $deliveryZone = $this->service->update($request, $id);
        return response()->json($deliveryZone, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $deliveryZone = $this->service->restore($id);
        return response()->json($deliveryZone, Response::HTTP_OK);
    }
}
