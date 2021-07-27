<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
	protected $fillable = ['nombre_empresa','rif_empresa','telefono_empresa','direccion','user_id'];
}
