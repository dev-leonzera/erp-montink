<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produto;

class ListaProdutos extends Component
{
    public function adicionarAoCarrinho($produtoId)
    {
        $carrinho = session()->get('carrinho', []);
        if (isset($carrinho[$produtoId])) {
            $carrinho[$produtoId]['quantidade']++;
        } else {
            $produto = Produto::with('estoque')->findOrFail($produtoId);
            $carrinho[$produtoId] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => 1
            ];
        }
        session(['carrinho' => $carrinho]);
        $this->dispatch('carrinhoAtualizado');
    }

    public function render()
    {
        $produtos = Produto::with('estoque')->get();
        return view('livewire.lista-produtos', compact('produtos'));
    }
}
