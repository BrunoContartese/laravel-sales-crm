<?php

namespace App\Services\Administration;

use App\Models\Administration\Seller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellersService
{
    private $relations = [
        'destroyer',
        'deliveryZone',
        'documentType'
    ];

    public function index($request)
    {
        $sellers = Seller::with($this->relations);

        if( $request->has('q') ) {
            $sellers->where(function($q) use($request) {
                $q->where('given_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('family_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->orWhere('document', 'LIKE', "{$request->q}");
            });
        }

        if( $request->has('delivery_zone_id') ) {
            $sellers->where('delivery_zone_id', $request->delivery_zone_id);
        }

        if($request->has('status') && $request->status == '*') {
            $sellers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $sellers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $sellers->orderBy( $request->orderBy, $request->orderType );
        }

        return $sellers->get();
    }

    public function paginated($request)
    {
        $sellers = Seller::with($this->relations);

        if( $request->has('q') ) {
            $sellers->where(function($q) use($request) {
                $q->where('given_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('family_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->orWhere('document', 'LIKE', "{$request->q}");
            });
        }

        if( $request->has('delivery_zone_id') ) {
            $sellers->where('delivery_zone_id', $request->delivery_zone_id);
        }

        if($request->has('status') && $request->status == '*') {
            $sellers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $sellers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $sellers->orderBy( $request->orderBy, $request->orderType );
        }

        return $sellers->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $seller = Seller::create([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'document' => $request->document,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'celphone_number' => $request->celphone_number,
                'document_type_id' => $request->document_type_id,
                'delivery_zone_id' => $request->delivery_zone_id
            ]);
            DB::commit();
            return $seller;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (SellersService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return Seller::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $seller = Seller::withTrashed()->with($this->relations)->findOrFail($id);
            $seller->update([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'document' => $request->document,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'celphone_number' => $request->celphone_number,
                'document_type_id' => $request->document_type_id,
                'delivery_zone_id' => $request->delivery_zone_id
            ]);
            DB::commit();
            return $seller;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (SellersService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
    }

    public function restore($id)
    {
        $seller = Seller::withTrashed()->with($this->relations)->findOrFail($id);
        $seller->restore();
        return $seller;
    }
}
