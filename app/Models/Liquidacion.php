<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table ="liquidaciones";    
    
    public function taxi()
    {                
        return $this->belongsTo('App\Models\Taxi', 'taxi_id');
    }
    
    public function chofer()
    {
        return $this->belongsTo('App\Models\Chofer', 'chofer_id');
    }

    public function turno()
    {
        return $this->belongsTo('App\Models\Turno', 'turno_id');
    }

}

