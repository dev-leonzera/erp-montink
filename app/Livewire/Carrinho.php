<?php

namespace App\Livewire;

use Livewire\Component;

class Carrinho extends Component
{
    public $itens = [];
    public $subtotal = 0;
    public $frete = 0;
    public $total = 0;

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
        $this->total = $this->subtotal + $this->frete;
    }

    public function render()
    {
        return view('livewire.carrinho');
    }
}
