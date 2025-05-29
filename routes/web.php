<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\ListaProdutos;
use App\Livewire\Carrinho;
use App\Livewire\Checkout;
use App\Livewire\CadastroCupom;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Pedido;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/produtos', ListaProdutos::class)->name('produtos');
Route::get('/carrinho', Carrinho::class)->name('carrinho');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/cupons/cadastro', CadastroCupom::class)->name('cupons.cadastro');

Route::post('/webhook/update-status', function(Request $request) {
    $request->validate([
        'id' => 'required|integer|exists:pedidos,id',
        'status' => 'required|string',
    ]);
    $pedido = Pedido::find($request->id);
    if ($request->status === 'cancelado') {
        $pedido->delete();
        return response()->json(['message' => 'Pedido cancelado e removido.']);
    } else {
        $pedido->status = $request->status;
        $pedido->save();
        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
});

require __DIR__.'/auth.php';
