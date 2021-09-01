<?php

namespace App\Services\Administration;

use App\Models\Administration\BranchOffice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BranchOfficesService
{
    private $relations = ['destroyer'];

    public function index($request)
    {
        $branchOffices = BranchOffice::with($this->relations);

        if($request->has('status') && $request->status == '*') {
            $branchOffices->withTrashed();
        } else if ($request->has('status') && !$request->status) {
            $branchOffices->trashed();
        }

        if( $request->has('q') ) {
            $branchOffices->where('name', 'like', "%{$request->q}%");
        }

        if( $request->has('orderBy') ) {
            $branchOffices->orderBy( $request->orderBy, $request->orderType );
        }

        return $branchOffices->get();
    }

    public function paginated($request)
    {
        $branchOffices = BranchOffice::with($this->relations);

        if($request->status == '*') {
            $branchOffices->withTrashed();
        } else if ($request->status != '*' && $request->status == 2) {
            $branchOffices->onlyTrashed();
        }

        if( $request->has('q') ) {
            $branchOffices->where('name', 'like', "%{$request->q}%");
        }

        if( $request->has('orderBy') ) {
            $branchOffices->orderBy( $request->orderBy, $request->orderType );
        }

        return $branchOffices->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $branchOffice = BranchOffice::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'lat' => $request->lat,
                'long' => $request->long
            ]);
            DB::commit();
            return $branchOffice;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (BranchOfficesService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return BranchOffice::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $branchOffice = BranchOffice::with($this->relations)->findOrFail($id);
            $branchOffice->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'lat' => $request->lat,
                'long' => $request->long
            ]);
            DB::commit();
            return $branchOffice;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (BranchOfficesService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $branchOffice = BranchOffice::findOrFail($id);
        $branchOffice->delete();
    }

    public function restore($id)
    {
        $branchOffice = BranchOffice::withTrashed()->with($this->relations)->findOrFail($id);
        $branchOffice->restore();
        return $branchOffice;
    }
}
