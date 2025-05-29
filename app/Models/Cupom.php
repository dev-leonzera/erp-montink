<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $fillable = ['codigo', 'valor_desconto', 'validade', 'valor_minimo'];
}
