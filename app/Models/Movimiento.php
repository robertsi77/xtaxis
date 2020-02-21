<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table ="movimientos";   
    
    
    public function concepto()
    {
        return $this->belongsTo('App\Models\Concepto', 'concepto_id');
    }
    public function taxi()
    {
        return $this->belongsTo('App\Models\Taxi', 'taxi_id');
    }
    public function chofer()
    {
        return $this->belongsTo('App\Models\Chofer', 'chofer_id');
    }
}

