<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    protected $table ="taxis";     

    public function propietario()
    {
        return $this->belongsTo('App\Models\Propietario', 'propietario_id');
    }
    public function marca()
    {
        return $this->belongsTo('App\Models\MarcaVehiculo', 'marca_id');
    }    
    public function linea()
    {
        return $this->belongsTo('App\Models\LineaVehiculo', 'linea_id');
    }
    
}
