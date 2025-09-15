<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    // Apunta a la tabla existente
    protected $table = 'departamento';

    // Campos que se pueden llenar masivamente
    protected $fillable = ['nombre', 'descripcion', 'subcuenta'];
}
