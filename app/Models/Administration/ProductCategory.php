<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ProductCategory extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public static $rules = [
        'name' => 'required|unique:product_categories,name',
        'parent_id' => 'nullable|exists:product_categories,id'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre de la categoría.',
        'name.unique' => 'El nombre ingresado ya está registrado.',
        'parent_id.exists' => 'La categoría padre no es válida.'
    ];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }


}
