<?php

namespace App\Services\Accounting;

use App\Models\Accounting\PriceList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriceListsService
{
    private $relations = [
        'destroyer'
    ];

    public function index($request)
    {
        $priceLists = PriceList::with($this->relations);

        if($request->has('status') && $request->status == '*') {
            Log::info("withTrashed");
        } else if ($request->has('status') && $request->status == 2) {
            $priceLists->onlyTrashed();
        }

        if( $request->has('q') ) {
            $priceLists->where('name', 'like', "%{$request->q}%");
        }

        if( $request->has('orderBy') ) {
            $priceLists->orderBy( $request->orderBy, $request->orderType );
        }

        return $priceLists->get();
    }

    public function paginated($request)
    {
        $priceLists = PriceList::with($this->relations);

        if($request->has('status') && $request->status == '*') {
            $priceLists->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $priceLists->onlyTrashed();
        }

        if( $request->has('q') ) {
            $priceLists->where('name', 'like', "%{$request->q}%");
        }

        if( $request->has('orderBy') ) {
            $priceLists->orderBy( $request->orderBy, $request->orderType );
        }

        return $priceLists->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $priceList = PriceList::create([
                'name' => $request->name
            ]);
            DB::commit();
            return $priceList;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (PriceListsService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return PriceList::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $priceList = PriceList::withTrashed()->with($this->relations)->findOrFail($id);
            $priceList->update([
                'name' => $request->name
            ]);
            DB::commit();
            return $priceList;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (PriceListsService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $priceList = PriceList::findOrFail($id);
        $priceList->delete();
    }

    public function restore($id)
    {
        $priceList = PriceList::withTrashed()->with($this->relations)->findOrFail($id);
        $priceList->restore();
        return $priceList;
    }
}
