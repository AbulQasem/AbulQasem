<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
    
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'profesores_id');
    }

}
