<?php

namespace App\Services\Administration;

use App\Models\Administration\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomersService
{
    private $relations = [
        'destroyer',
        'documentType',
        'fiscalRole',
        'priceList',
        'deliveryZone',
        'seller',
    ];

    public function index($request)
    {
        $customers = Customer::with($this->relations);

        if( $request->has('q') ) {
            $customers->where(function($q) use($request) {
                $q->where('given_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('family_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->orWhere('document', 'LIKE', "{$request->q}");
            });
        }

        if($request->has('documentType')) {
            $customers->where('document_type_id', $request->documentType);
        }

        if($request->has('fiscalRole')) {
            $customers->where('fiscal_role_id', $request->fiscalRole);
        }

        if($request->has('priceList')) {
            $customers->where('price_list_id', $request->priceList);
        }

        if($request->has('deliveryZone')) {
            $customers->where('delivery_zone_id', $request->deliveryZone);
        }

        if($request->has('seller')) {
            $customers->where('seller_id', $request->seller);
        }

        if($request->has('status') && $request->status == '*') {
            $customers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $customers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $customers->orderBy( $request->orderBy, $request->orderType );
        }

        return $customers->get();
    }

    public function paginated($request)
    {
        $customers = Customer::with($this->relations);

        if( $request->has('q') ) {
            $customers->where(function($q) use($request) {
                $q->where('given_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('family_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->orWhere('document', 'LIKE', "{$request->q}");
            });
        }

        if($request->has('documentType')) {
            $customers->where('document_type_id', $request->documentType);
        }

        if($request->has('fiscalRole')) {
            $customers->where('fiscal_role_id', $request->fiscalRole);
        }

        if($request->has('priceList')) {
            $customers->where('price_list_id', $request->priceList);
        }

        if($request->has('deliveryZone')) {
            $customers->where('delivery_zone_id', $request->deliveryZone);
        }

        if($request->has('seller')) {
            $customers->where('seller_id', $request->seller);
        }

        if($request->has('status') && $request->status == '*') {
            $customers->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $customers->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $customers->orderBy( $request->orderBy, $request->orderType );
        }

        return $customers->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::create([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'document_type_id' => $request->document_type_id,
                'document' => $request->document,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'fiscal_role_id' => $request->fiscal_role_id,
                'price_list_id' => $request->price_list_id,
                'delivery_zone_id' => $request->delivery_zone_id,
                'seller_id' => $request->seller_id,
                'enable_current_account' => $request->enable_current_account
            ]);
            DB::commit();
            return $customer;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (CustomersService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return Customer::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::withTrashed()->with($this->relations)->findOrFail($id);
            $customer->update([
                'given_name' => $request->given_name,
                'family_name' => $request->family_name,
                'address' => $request->address,
                'document_type_id' => $request->document_type_id,
                'document' => $request->document,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'fiscal_role_id' => $request->fiscal_role_id,
                'price_list_id' => $request->price_list_id,
                'delivery_zone_id' => $request->delivery_zone_id,
                'seller_id' => $request->seller_id,
                'enable_current_account' => $request->enable_current_account
            ]);
            DB::commit();
            return $customer;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (CustomersService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }

    public function restore($id)
    {
        $customer = Customer::withTrashed()->with($this->relations)->findOrFail($id);
        $customer->restore();
        return $customer;
    }
}
