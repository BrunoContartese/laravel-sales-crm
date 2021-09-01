<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class DeliveryZone extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'required|unique:delivery_zones,name'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre de la zona de entrega',
        'name.unique' => 'El nombre ingresado ya pertenece a otra zona de entrega.'
    ];

    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }
}
