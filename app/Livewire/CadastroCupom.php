<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cupom;

class CadastroCupom extends Component
{
    public $codigo;
    public $valor_desconto;
    public $validade;
    public $valor_minimo;
    public $mensagem = '';

    public function cadastrar()
    {
        $this->validate([
            'codigo' => 'required|unique:cupoms,codigo',
            'valor_desconto' => 'required|numeric|min:0.01',
            'validade' => 'required|date',
            'valor_minimo' => 'required|numeric|min:0',
        ]);
        Cupom::create([
            'codigo' => strtoupper($this->codigo),
            'valor_desconto' => $this->valor_desconto,
            'validade' => $this->validade,
            'valor_minimo' => $this->valor_minimo,
        ]);
        $this->reset(['codigo', 'valor_desconto', 'validade', 'valor_minimo']);
        $this->mensagem = 'Cupom cadastrado com sucesso!';
    }

    public function render()
    {
        return view('livewire.cadastro-cupom');
    }
}
