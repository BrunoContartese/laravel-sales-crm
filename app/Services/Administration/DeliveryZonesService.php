<?php

namespace App\Services\Administration;

use App\Models\Administration\DeliveryZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryZonesService
{
    private $relations = [
        'destroyer'
    ];

    public function index($request)
    {
        $deliveryZones = DeliveryZone::with($this->relations);

        if( $request->has('q') ) {
            $deliveryZones->where('name', 'LIKE', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $deliveryZones->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $deliveryZones->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $deliveryZones->orderBy( $request->orderBy, $request->orderType );
        }

        return $deliveryZones->get();
    }

    public function paginated($request)
    {
        $deliveryZones = DeliveryZone::with($this->relations);

        if( $request->has('q') ) {
            $deliveryZones->where('name', 'LIKE', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $deliveryZones->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $deliveryZones->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $deliveryZones->orderBy( $request->orderBy, $request->orderType );
        }

        return $deliveryZones->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $deliveryZone = DeliveryZone::create($request->all());
            DB::commit();
            return $deliveryZone;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (DeliveryZonesService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return DeliveryZone::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $deliveryZone = DeliveryZone::withTrashed()->with($this->relations)->findOrFail($id);
            $deliveryZone->update($request->all());
            DB::commit();
            return $deliveryZone;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (DeliveryZonesService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $deliveryZone = DeliveryZone::findOrFail($id);
        $deliveryZone->delete();
    }

    public function restore($id)
    {
        $deliveryZone = DeliveryZone::withTrashed()->with($this->relations)->findOrFail($id);
        $deliveryZone->restore();
        return $deliveryZone;
    }
}
