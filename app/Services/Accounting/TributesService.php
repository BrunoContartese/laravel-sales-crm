<?php

namespace App\Services\Accounting;

use App\Models\Accounting\Tribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TributesService
{
    private $relations = [
        'aliquots'
    ];

    public function index($request)
    {
        $tributes = Tribute::with($this->relations);

        if( $request->has('q') ) {
            $tributes->where('name', 'LIKE', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $tributes->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $tributes->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $tributes->orderBy( $request->orderBy, $request->orderType );
        }

        return $tributes->get();
    }

    public function paginated($request)
    {
        $tributes = Tribute::with($this->relations);

        if( $request->has('q') ) {
            $tributes->where('name', 'LIKE', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $tributes->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $tributes->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $tributes->orderBy( $request->orderBy, $request->orderType );
        }

        return $tributes->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $tribute = Tribute::create([
                'code' => $request->code,
                'name' => $request->name,
            ]); 
            DB::commit();
            return $tribute;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (TributesService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return Tribute::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $tribute = Tribute::withTrashed()->with($this->relations)->findOrFail($id);
            $tribute->update([
                'code' => $request->code,
                'name' => $request->name,
            ]);
            DB::commit();
            return $tribute;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (TributesService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $tribute = Tribute::findOrFail($id);
        $tribute->delete();
    }

    public function restore($id)
    {
        $tribute = Tribute::withTrashed()->with($this->relations)->findOrFail($id);
        $tribute->restore();
        return $tribute;
    }
}
