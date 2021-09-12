<?php

namespace App\Services\Administration;

use App\Models\Administration\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuppliersService
{
    private $relations = [
        'fiscalRole',
        'documentType',
        'accountingRecord',
        'destroyer'
    ];

    public function index($request)
    {
        $suppliers = Supplier::with($this->relations);

        if( $request->has('q') ) {
            $suppliers->where(function($q) use($request) {
                $q->where('given_name', 'like', "%{$request->q}%")
                    ->orWhere('family_name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%")
                    ->orWhere('document_number', 'like', "{$request->q}");
            });
        }

        if($request->has('fiscal_role_id')) {
            $suppliers->where('fiscal_role_id', $request->fiscal_role_id);
        }

        if($request->has('status') && $request->status == '*') {
            $suppliers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $suppliers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $suppliers->orderBy( $request->orderBy, $request->orderType );
        }

        return $suppliers->get();
    }

    public function paginated($request)
    {
        $suppliers = Supplier::with($this->relations);

        if( $request->has('q') ) {
            $suppliers->where(function($q) use($request) {
                $q->where('given_name', 'like', "%{$request->q}%")
                    ->orWhere('family_name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%")
                    ->orWhere('document_number', 'like', "{$request->q}");
            });
        }

        if($request->has('fiscal_role_id')) {
            $suppliers->where('fiscal_role_id', $request->fiscal_role_id);
        }

        if($request->has('status') && $request->status == '*') {
            $suppliers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $suppliers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $suppliers->orderBy( $request->orderBy, $request->orderType );
        }

        return $suppliers->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::create([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'fiscal_role_id' => $request->fiscal_role_id,
                'document_type_id' => $request->document_type_id,
                'document_number' => $request->document_number,
                'comments' => $request->comments,
                'accounting_record_id' => $request->accounting_record_id
            ]);
            DB::commit();
            return $supplier;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (SuppliersService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return Supplier::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::withTrashed()->with($this->relations)->findOrFail($id);
            $supplier->update([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'fiscal_role_id' => $request->fiscal_role_id,
                'document_type_id' => $request->document_type_id,
                'document_number' => $request->document_number,
                'comments' => $request->comments,
                'accounting_record_id' => $request->accounting_record_id
            ]);
            DB::commit();
            return $supplier;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (SuppliersService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
    }

    public function restore($id)
    {
        $supplier = Supplier::withTrashed()->with($this->relations)->findOrFail($id);
        $supplier->restore();
        return $supplier;
    }
}
