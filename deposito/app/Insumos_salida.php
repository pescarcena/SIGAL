<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumos_salida extends Model
{
    protected $fillable = ['salida','insumo', 'solicitado', 'despachado',
                          'deposito', 'existencia'];
    protected $hidden   = ['created_at' , 'updated_at'];
}
