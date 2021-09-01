<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class PriceList extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'required|unique:price_lists,name'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre de la lista de precios.',
        'name.unique' => 'El nombre ingresado ya está asignado a otra lista.'
    ];

}
