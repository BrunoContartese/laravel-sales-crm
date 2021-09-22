<?php

namespace App\Models\Administration;

use App\Models\Accounting\PriceList;
use App\Models\Accounting\Tribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'barcode',
        'name',
        'description',
        'product_img_url',
        'product_category_id',
        'tribute_aliquot_id'
    ];

    public static $rules = [
        'barcode' => 'required|unique:products,barcode',
        'name' => 'required',
        'product_category_id' => 'required|exists:product_categories,id',
        'tribute_aliquot_id' => 'required|exists:tributes,id',
        'suppliers' => 'array|min:1',
        'suppliers.*' => 'exists:suppliers,id',
        'branchOfficeStock' => 'array|min:1',
        'branchOfficeStock.*' => 'exists:branch_offices,id'
    ];

    public static $messages = [
        'barcode.required' => 'Debe ingresar el código de barras',
        'barcode.unique' => 'El código de barras ingresado ya está siendo utilizado por otro producto.',
        'product_category_id.required' => 'Debe seleccionar la categoría del producto',
        'product_category_id.exists' => 'La categoría seleccionada no es válida.',
        'tribute_aliquot_id.required' => 'Debe seleccionar la alícuota de IVA.',
        'tribute_aliquot_id.exists' => 'La alícuota de IVA seleccionada no es válida.',
        'suppliers.min' => 'Debe seleccionar al menos 1 proveedor',
        'branchOfficeStock.min' => 'Debe declarar la existencia del producto en al menos 1 sucursal.',
        'suppliers.*.exists' => 'El proveedor elegido no es válido.',
        'branchOfficeStock.*.exists' => 'La sucursal elegida no es válida.'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class)->with(['parent', 'children'])->withTrashed();
    }

    public function tribute()
    {
        return $this->belongsTo(Tribute::class);
    }

    public function priceLists()
    {
        return $this->belongsToMany(PriceList::class, 'products__price_lists')->withPivot([
            'rentability_aliquot',
            'untaxed_price',
            'aliquot',
            'taxed_price',
        ])->withTrashed();  
    }

    public function branchOfficeStock()
    {
        return $this->belongsToMany(BranchOffice::class, 'products__branch_offices')->withPivot([
            'current_stock',
            'minimum_stock',
        ]);  
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'products__suppliers')->withPivot([
            'cost_price'
        ])->withTrashed();  
    }
}