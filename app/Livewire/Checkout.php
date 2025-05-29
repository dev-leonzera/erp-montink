<?php

namespace App\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $cep = '';
    public $rua = '';
    public $bairro = '';
    public $cidade = '';
    public $uf = '';

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

    public function render()
    {
        return view('livewire.checkout');
    }
}
