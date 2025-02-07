@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Nova Entrada - {{ $product->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('stock.in.store', $product) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Fornecedor</label>
                    <select class="form-select" id="supplier_id" name="supplier_id" required>
                        <option value="">Selecione um fornecedor</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
                </div>
                <div class="mb-3">
                    <label for="unit_price" class="form-label">Valor Unitário</label>
                    <input type="number" class="form-control" id="unit_price" name="unit_price" required step="0.01" min="0">
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Observações</label>
                    <textarea class="form-control" id="notes" name="notes"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Registrar Entrada</button>
                <a href="{{ route('stock.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
