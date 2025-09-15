<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puesto extends Model
{
    protected $table = 'puesto';

    use SoftDeletes; // Habilita borrado lógico (deleted_at)

    protected $fillable = ['nombre'];
}
