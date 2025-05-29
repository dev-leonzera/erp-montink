<div class="container mt-4">
    <h2>Carrinho</h2>
    @if(count($itens) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $item)
                    <tr>
                        <td>{{ $item['nome'] }}</td>
                        <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <p>Subtotal: <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong></p>
            <p>Frete: <strong>R$ {{ number_format($frete, 2, ',', '.') }}</strong></p>
            <p>Total: <strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></p>
        </div>
    @else
        <p>O carrinho está vazio.</p>
    @endif
    <div class="mt-4">
        <form wire:submit.prevent="aplicarCupom" class="row g-2 align-items-end">
            <div class="col-auto">
                <label for="cupom_codigo" class="form-label">Cupom</label>
                <input type="text" class="form-control" id="cupom_codigo" wire:model="cupom_codigo" placeholder="Código do cupom">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Aplicar</button>
            </div>
        </form>
        @if($mensagem_cupom)
            <div class="mt-2 alert alert-info">{{ $mensagem_cupom }}</div>
        @endif
        @if($desconto > 0)
            <p class="mt-2">Desconto: <strong>-R$ {{ number_format($desconto, 2, ',', '.') }}</strong></p>
        @endif
    </div>
</div>
