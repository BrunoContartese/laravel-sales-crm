<?php

namespace App\Services\Administration;

use App\Models\Administration\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductsService
{
    private $relations = [
        'productCategory',
        'suppliers',
        'branchOfficeStock',
        'priceLists',
        'tribute',
    ];

    public function index($request)
    {
        $products = Product::with($this->relations);

        if( $request->has('q') ) {
            $products->where(function($q) use($request) {
                $q->where('barcode', 'LIKE', $request->q)
                    ->where('name', 'LIKE', "%{$request->q}%");
            });
        }

        if( $request->has('supplier_id') && $request->supplier_id != '*') {
            $products->whereHas('suppliers', function($q) use($request) {
                $q->where('id', $request->supplier_id);
            });
        }

        if($request->has('status') && $request->status == '*') {
            $products->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $products->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $products->orderBy( $request->orderBy, $request->orderType );
        }

        return $products->get();
    }

    public function paginated($request)
    {
        $products = Product::with($this->relations);

        if( $request->has('q') ) {
            $products->where(function($q) use($request) {
                $q->where('barcode', 'LIKE', $request->q)
                    ->orWhere('name', 'LIKE', "%{$request->q}%");
            });
        }

        if( $request->has('supplier_id') && $request->supplier_id != '*') {
            $products->whereHas('suppliers', function($q) use($request) {
                $q->where('id', $request->supplier_id);
            });
        }

        if($request->has('status') && $request->status == '*') {
            $products->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $products->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $products->orderBy( $request->orderBy, $request->orderType );
        }

        return $products->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->all());
            $product->suppliers()->sync($request->suppliers);
            $product->branchOfficeStock()->sync($request->branchOfficeStock);
            DB::commit();
            return $product;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (ProductsService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return Product::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::withTrashed()->with($this->relations)->findOrFail($id);
            $product->update($request->all());

            if($request->has('suppliers')) {
                $product->suppliers()->sync($request->suppliers);
            }

            if($request->has('branchOfficeStock')) {
                $product->branchOfficeStock()->sync($request->branchOfficeStock);
            }
        
            DB::commit();
            return $product;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (ProductsService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->with($this->relations)->findOrFail($id);
        $product->restore();
        return $product;
    }
}
