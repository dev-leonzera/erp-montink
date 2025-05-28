<div class="container mt-4">
    <h2>Produtos</h2>
    <div class="row">
        @foreach($produtos as $produto)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text">Preço: R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        <p class="card-text">Estoque: {{ $produto->estoque->quantidade ?? 0 }}</p>
                        <button class="btn btn-primary" wire:click="adicionarAoCarrinho({{ $produto->id }})" @if(($produto->estoque->quantidade ?? 0) < 1) disabled @endif>Comprar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
