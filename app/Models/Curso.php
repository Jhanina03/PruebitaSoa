<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    //
    protected $table='cursos';
    protected $filleable=["nombre"];
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class);
    }
}
