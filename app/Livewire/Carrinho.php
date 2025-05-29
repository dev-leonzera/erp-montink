<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cupom;

class Carrinho extends Component
{
    public $itens = [];
    public $subtotal = 0;
    public $frete = 0;
    public $total = 0;
    public $cupom_codigo = '';
    public $cupom_aplicado = null;
    public $desconto = 0;
    public $mensagem_cupom = '';

    protected $listeners = ['carrinhoAtualizado' => 'atualizarCarrinho'];

    public function mount()
    {
        $this->atualizarCarrinho();
    }

    public function atualizarCarrinho()
    {
        $this->itens = session('carrinho', []);
        $this->subtotal = collect($this->itens)->sum(function($item) {
            return $item['preco'] * $item['quantidade'];
        });
        // Regra de frete
        if ($this->subtotal >= 200) {
            $this->frete = 0;
        } elseif ($this->subtotal >= 52 && $this->subtotal <= 166.59) {
            $this->frete = 15;
        } else {
            $this->frete = 20;
        }
        $total = $this->subtotal + $this->frete;
        if ($this->cupom_aplicado) {
            $total -= $this->desconto;
            if ($total < 0) $total = 0;
        }
        $this->total = $total;
        session(['total_checkout' => $this->total]);
    }

    public function aplicarCupom()
    {
        $this->mensagem_cupom = '';
        $cupom = Cupom::where('codigo', strtoupper($this->cupom_codigo))->first();
        if (!$cupom) {
            $this->mensagem_cupom = 'Cupom não encontrado.';
            $this->desconto = 0;
            $this->cupom_aplicado = null;
            $this->atualizarCarrinho();
            return;
        }
        if (now()->gt($cupom->validade)) {
            $this->mensagem_cupom = 'Cupom expirado.';
            $this->desconto = 0;
            $this->cupom_aplicado = null;
            $this->atualizarCarrinho();
            return;
        }
        if ($this->subtotal < $cupom->valor_minimo) {
            $this->mensagem_cupom = 'Valor mínimo para uso do cupom: R$ ' . number_format($cupom->valor_minimo, 2, ',', '.');
            $this->desconto = 0;
            $this->cupom_aplicado = null;
            $this->atualizarCarrinho();
            return;
        }
        $this->desconto = $cupom->valor_desconto;
        $this->cupom_aplicado = $cupom;
        $this->mensagem_cupom = 'Cupom aplicado com sucesso!';
        $this->atualizarCarrinho();
    }

    public function render()
    {
        return view('livewire.carrinho');
    }
}
