<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Mail;

class Checkout extends Component
{
    public $cep = '';
    public $rua = '';
    public $bairro = '';
    public $cidade = '';
    public $uf = '';
    public $nome_cliente = '';
    public $email_cliente = '';
    public $mensagem = '';

    public function updatedCep($value)
    {
        $cep = preg_replace('/[^0-9]/', '', $value);
        if (strlen($cep) === 8) {
            $this->buscarEndereco($cep);
        }
    }

    public function buscarEndereco($cep)
    {
        $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        if ($response) {
            $data = json_decode($response, true);
            if (!isset($data['erro'])) {
                $this->rua = $data['logradouro'] ?? '';
                $this->bairro = $data['bairro'] ?? '';
                $this->cidade = $data['localidade'] ?? '';
                $this->uf = $data['uf'] ?? '';
            }
        }
    }

    public function finalizarPedido()
    {
        $this->validate([
            'nome_cliente' => 'required',
            'email_cliente' => 'required|email',
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ]);
        $carrinho = session('carrinho', []);
        $total = session('total_checkout', 0);
        if (empty($carrinho)) {
            $this->mensagem = 'Carrinho vazio.';
            return;
        }
        $pedido = Pedido::create([
            'nome_cliente' => $this->nome_cliente,
            'email_cliente' => $this->email_cliente,
            'cep' => $this->cep,
            'rua' => $this->rua,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'total' => $total,
            'status' => 'novo',
            'itens' => json_encode($carrinho),
        ]);
        // Enviar e-mail
        Mail::raw(
            "Pedido #{$pedido->id} realizado!\n\nCliente: {$pedido->nome_cliente}\nE-mail: {$pedido->email_cliente}\nEndereço: {$pedido->rua}, {$pedido->bairro}, {$pedido->cidade} - {$pedido->uf}, CEP: {$pedido->cep}\nTotal: R$ ".number_format($pedido->total,2,',','.') . "\n\nItens: ".print_r($carrinho, true),
            function($message) use ($pedido) {
                $message->to($pedido->email_cliente)
                        ->subject('Confirmação de Pedido');
            }
        );
        session()->forget(['carrinho', 'total_checkout']);
        $this->mensagem = 'Pedido finalizado e e-mail enviado!';
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
