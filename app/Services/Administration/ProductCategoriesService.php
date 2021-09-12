<?php

namespace App\Services\Administration;

use App\Models\Administration\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductCategoriesService
{
    private $relations = [
        'children'
    ];

    public function index($request)
    {
        $productCategories = ProductCategory::with($this->relations);

        if( $request->has('q') ) {
            $productCategories->where('name', 'like', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $productCategories->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $productCategories->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $productCategories->orderBy( $request->orderBy, $request->orderType );
        }

        if($request->has('only_root_records')) {
            $productCategories->whereParentId(null);
        }

        return $productCategories->get();
    }

    public function paginated($request)
    {
        $productCategories = ProductCategory::with($this->relations);

        if( $request->has('q') ) {
            $productCategories->where('name', 'like', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $productCategories->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $productCategories->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $productCategories->orderBy( $request->orderBy, $request->orderType );
        }

        if($request->has('only_root_records')) {
            $productCategories->whereParentId(null);
        }

        return $productCategories->paginate($request->page_size ?? 15);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $productCategory = ProductCategory::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);
            DB::commit();
            return $productCategory;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (ProductCategoriesService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return ProductCategory::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $productCategory = ProductCategory::withTrashed()->with($this->relations)->findOrFail($id);
            if($productCategory->parent_id == null && $productCategory->children()->count() > 0 &&  $request->parent_id != null) {
                Log::info('ENTRE');
                throw ValidationException::withMessages(['errors' => [
                    'root_category' => 'No puede convertir en sub-categoría a una categoría principal.'
                ]]);
            }
            $productCategory->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);
            DB::commit();
            return $productCategory;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (ProductCategoriesService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        $productCategory->delete();
    }

    public function restore($id)
    {
        $productCategory = ProductCategory::withTrashed()->with($this->relations)->findOrFail($id);
        $productCategory->restore();
        return $productCategory;
    }
}
