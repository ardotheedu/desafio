@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar Produto</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" class="form-control" id="code" name="code"
                           value="{{ old('code', $product->code) }}" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estoque Atual</label>
                    <input type="text" class="form-control" value="{{ $product->stock }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Preço Médio</label>
                    <input type="text" class="form-control"
                           value="R$ {{ number_format($product->average_price, 2, ',', '.') }}" disabled>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
