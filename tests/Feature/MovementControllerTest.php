<?php

namespace Tests\Feature;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_movements_view()
    {
        $response = $this->get(route('movements.index'));
        $response->assertStatus(200);
        $response->assertViewIs('movements.index');
    }

    public function test_index_includes_supplier_info()
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

        Movement::create([
            'type' => 'in',
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'quantity' => 10,
            'unit_price' => 15.00,
            'total_price' => 150.00,
        ]);

        $response = $this->get(route('movements.index'));
        $response->assertSee($supplier->name);
    }
}
