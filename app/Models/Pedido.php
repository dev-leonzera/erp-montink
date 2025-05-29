<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nome_cliente', 'email_cliente', 'cep', 'rua', 'bairro', 'cidade', 'uf', 'total', 'status', 'itens'
    ];
}
