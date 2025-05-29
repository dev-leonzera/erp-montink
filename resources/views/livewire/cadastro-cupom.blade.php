<div class="container mt-4">
    <h2>Cadastro de Cupom</h2>
    @if($mensagem)
        <div class="alert alert-success">{{ $mensagem }}</div>
    @endif
    <form wire:submit.prevent="cadastrar">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" wire:model="codigo" maxlength="20" required>
            @error('codigo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="valor_desconto" class="form-label">Valor do Desconto (R$)</label>
            <input type="number" step="0.01" class="form-control" id="valor_desconto" wire:model="valor_desconto" required>
            @error('valor_desconto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="validade" class="form-label">Validade</label>
            <input type="date" class="form-control" id="validade" wire:model="validade" required>
            @error('validade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="valor_minimo" class="form-label">Valor Mínimo do Pedido (R$)</label>
            <input type="number" step="0.01" class="form-control" id="valor_minimo" wire:model="valor_minimo" required>
            @error('valor_minimo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Cupom</button>
    </form>
</div>
