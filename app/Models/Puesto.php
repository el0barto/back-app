<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Puesto extends Model
{
    protected $table = 'puesto';
    protected $fillable = ['nombre', 'departamento_id'];

    // Un puesto pertenece a un departamento
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
}