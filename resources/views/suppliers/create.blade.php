@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Novo Fornecedor</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="document" class="form-label">Documento (CNPJ/CPF)</label>
                    <input type="text" class="form-control" id="document" name="document" value="{{ old('document') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Endereço</label>
                    <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
