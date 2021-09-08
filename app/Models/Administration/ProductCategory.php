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
        'name'
    ];

    public static $rules = [
        'name' => 'required',
        'parent_id' => 'nullable|exists:product_categories,id'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre de la categoría.',
        'parent_id.exists' => 'La categoría padre no es válida.'
    ];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }


}
