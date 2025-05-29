<div>
    {{-- Success is as dangerous as failure. --}}
</div>

<div class="container mt-4">
    <h2>Checkout</h2>
    <form wire:submit.prevent="finalizarPedido">
        <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" wire:model.lazy="cep" maxlength="9" placeholder="Digite o CEP">
        </div>
        <div class="mb-3">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua" wire:model="rua" readonly>
        </div>
        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" wire:model="bairro" readonly>
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" wire:model="cidade" readonly>
        </div>
        <div class="mb-3">
            <label for="uf" class="form-label">UF</label>
            <input type="text" class="form-control" id="uf" wire:model="uf" readonly>
        </div>
        <div class="mb-3">
            <label for="nome_cliente" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome_cliente" wire:model="nome_cliente" required>
            @error('nome_cliente') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="email_cliente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_cliente" wire:model="email_cliente" required>
            @error('email_cliente') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Finalizar Pedido</button>
        @if($mensagem)
            <div class="alert alert-success mt-3">{{ $mensagem }}</div>
        @endif
    </form>
</div>
