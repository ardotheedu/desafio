<?php

namespace Tests\Feature;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_suppliers_view()
    {
        $response = $this->get(route('suppliers.index'));
        $response->assertStatus(200);
        $response->assertViewIs('suppliers.index');
    }

    public function test_store_creates_supplier()
    {
        $data = [
            'name' => 'Fornecedor Teste',
            'document' => '71.743.728/0001-51',
            'email' => 'teste@fornecedor.com',
            'phone' => '123456789',
            'address' => 'Endereço Teste',
        ];

        $response = $this->post(route('suppliers.store'), $data);
        $this->assertDatabaseHas('suppliers', $data);
        $response->assertRedirect(route('suppliers.index'));
    }

    public function test_update_supplier()
    {
        $supplier = Supplier::create([
            'name' => 'Fornecedor Teste',
            'document' => '71.743.728/0001-51',
            'email' => 'teste@fornecedor.com',
            'phone' => '123456789',
            'address' => 'Endereço Teste',
        ]);

        $data = [
            'name' => 'Fornecedor Atualizado',
            'document' => '23.131.011/0001-06',
            'email' => 'atualizado@fornecedor.com',
            'phone' => '987654321',
            'address' => 'Endereço Atualizado',
        ];

        $response = $this->put(route('suppliers.update', $supplier), $data);
        $this->assertDatabaseHas('suppliers', $data);
        $response->assertRedirect(route('suppliers.index'));
    }

    public function test_destroy_supplier()
    {
        $supplier = Supplier::create([
            'name' => 'Fornecedor Teste',
            'document' => '123456789',
            'email' => 'teste@fornecedor.com',
            'phone' => '123456789',
            'address' => 'Endereço Teste',
        ]);

        $response = $this->delete(route('suppliers.destroy', $supplier));
        $this->assertSoftDeleted('suppliers', ['id' => $supplier->id]);
        $response->assertRedirect(route('suppliers.index'));
    }
}
