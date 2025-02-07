<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Movement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_in_creates_movement()
    {
        $supplier = Supplier::create([
            'name' => 'Fornecedor Teste',
            'document' => '123456789',
        ]);

        $product = Product::create([
            'name' => 'Produto Teste',
            'code' => 'P001',
            'average_price' => 10.00,
            'stock' => 0,
        ]);

        $data = [
            'supplier_id' => $supplier->id,
            'quantity' => 10,
            'unit_price' => 15.00,
            'notes' => 'Entrada de teste',
        ];

        $response = $this->post(route('stock.in.store', $product), $data);
        $this->assertDatabaseHas('movements', [
            'type' => 'in',
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'quantity' => 10,
            'unit_price' => 15.00,
        ]);
        $response->assertRedirect(route('stock.index'));
    }

    public function test_store_out_creates_movement()
    {
        $supplier = Supplier::create([
            'name' => 'Fornecedor Teste',
            'document' => '123456789',
        ]);

        $product = Product::create([
            'name' => 'Produto Teste',
            'code' => 'P001',
            'average_price' => 10.00,
            'stock' => 20,
        ]);

        $data = [
            'destination' => 'Cliente Teste',
            'quantity' => 5,
            'notes' => 'Saída de teste',
        ];

        $response = $this->post(route('stock.out.store', $product), $data);
        $this->assertDatabaseHas('movements', [
            'type' => 'out',
            'product_id' => $product->id,
            'destination' => 'Cliente Teste',
            'quantity' => 5,
        ]);
        $response->assertRedirect(route('stock.index'));
    }
}
