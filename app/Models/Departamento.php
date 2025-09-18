<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $fillable = ['nombre', 'descripcion', 'subcuenta'];

    // Un departamento tiene muchos puestos
    public function puestos(): HasMany
    {
        return $this->hasMany(Puesto::class);
    }
}

