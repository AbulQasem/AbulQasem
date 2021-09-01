<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';



    public function padre()
    {
        return $this->belongsTo('App\Padre', 'padres_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
