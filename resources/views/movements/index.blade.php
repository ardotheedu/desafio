@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Histórico de Movimentações</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unit.</th>
                        <th>Valor Total</th>
                        <th>Fornecedor/Destino</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movements as $movement)
                        <tr>
                            <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($movement->type == 'in')
                                    <span class="badge bg-success">Entrada</span>
                                @else
                                    <span class="badge bg-warning">Saída</span>
                                @endif
                            </td>
                            <td>{{ $movement->product->name }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>R$ {{ number_format($movement->unit_price, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($movement->total_price, 2, ',', '.') }}</td>
                            <td>
                                @if($movement->type == 'in')
                                    {{ $movement->supplier ? $movement->supplier->name : 'Fornecedor não disponível' }}
                                @else
                                    {{ $movement->destination }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
