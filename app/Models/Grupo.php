<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    //Nombre de la tabla
    protected $table = 'grupos';


    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'grupos_id');
    }

    public function profesores()
    {
        return $this->belongsTo(Profesor::class, 'profesores_id');
    }
}
