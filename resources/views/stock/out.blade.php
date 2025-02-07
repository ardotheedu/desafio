@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Nova Saída - {{ $product->name }}</h2>
            <p>Estoque atual: {{ $product->stock }} | Preço médio: R$ {{ number_format($product->average_price, 2, ',', '.') }}</p>
        </div>
        <div class="card-body">
            <form action="{{ route('stock.out.store', $product) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="destination" class="form-label">Destino</label>
                    <input type="text" class="form-control" id="destination" name="destination" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required min="1" max="{{ $product->stock }}">
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Observações</label>
                    <textarea class="form-control" id="notes" name="notes"></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Registrar Saída</button>
                <a href="{{ route('stock.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
