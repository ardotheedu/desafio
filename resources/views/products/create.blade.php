@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Novo Produto</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
