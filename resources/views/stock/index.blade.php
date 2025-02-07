@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Controle de Estoque</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Estoque</th>
                        <th>Preço Médio</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>R$ {{ number_format($product->average_price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('stock.in.create', $product) }}" class="btn btn-sm btn-success">Entrada</a>
                                <a href="{{ route('stock.out.create', $product) }}" class="btn btn-sm btn-warning">Saída</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
