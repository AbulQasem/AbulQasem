<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Padre extends Model
{
    use HasFactory;

    protected $table = 'padres';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'padres_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'padres_id');
    }
}
