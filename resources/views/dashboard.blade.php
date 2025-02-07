@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text">Gerencie seu catálogo de produtos</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Ver Produtos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Fornecedores</h5>
                    <p class="card-text">Gerencie seus fornecedores</p>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-primary">Ver Fornecedores</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Movimentações</h5>
                    <p class="card-text">Controle entradas e saídas</p>
                    <a href="{{ route('movements.index') }}" class="btn btn-primary">Ver Movimentações</a>
                </div>
            </div>
        </div>
    </div>
@endsection
