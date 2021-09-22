<?php

namespace App\Services\Accounting;

use App\Models\Accounting\TributeAliquot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TributeAliquotsService
{
    private $relations = [];

    public function index($request)
    {
        $tributeAliquots = TributeAliquot::with($this->relations);

        if( $request->has('q') ) {
            $tributeAliquots->where('name', 'LIKE', "%{$request->q}%");
        }

        if( $request->has('tribute_id') ) {
            $tributeAliquots->where('tribute_id', $request->tribute_id);
        }

        if($request->has('status') && $request->status == '*') {
            $tributeAliquots->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $tributeAliquots->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $tributeAliquots->orderBy( $request->orderBy, $request->orderType );
        }

        return $tributeAliquots->get();
    }

    public function paginated($request)
    {
        $tributeAliquots = TributeAliquot::with($this->relations);

        if( $request->has('q') ) {
            $tributeAliquots->where('name', 'LIKE', "%{$request->q}%");
        }

        if( $request->has('tribute_id') ) {
            $tributeAliquots->where('tribute_id', $request->tribute_id);
        }

        if($request->has('status') && $request->status == '*') {
            $tributeAliquots->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $tributeAliquots->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $tributeAliquots->orderBy( $request->orderBy, $request->orderType );
        }

        return $tributeAliquots->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $tributeAliquot = TributeAliquot::create([
                'tribute_id' => $request->tribute_id,
                'code' => $request->code,
                'aliquot' => $request->aliquot
            ]);
            DB::commit();
            return $tributeAliquot;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (TributeAliquotsService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return TributeAliquot::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $tributeAliquot = TributeAliquot::withTrashed()->with($this->relations)->findOrFail($id);
            $tributeAliquot->update([
                'tribute_id' => $request->tribute_id,
                'code' => $request->code,
                'aliquot' => $request->aliquot
            ]);
            DB::commit();
            return $tributeAliquot;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (TributeAliquotsService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $tributeAliquot = TributeAliquot::findOrFail($id);
        $tributeAliquot->delete();
    }

    public function restore($id)
    {
        $tributeAliquot = TributeAliquot::withTrashed()->with($this->relations)->findOrFail($id);
        $tributeAliquot->restore();
        return $tributeAliquot;
    }
}
