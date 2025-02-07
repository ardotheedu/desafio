<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:products',
            'description' => 'nullable',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produto criado com sucesso.');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:products,code,' . $product->id,
            'description' => 'nullable',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')
                ->with('success', 'Produto removido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'Não é possível excluir o produto pois existem movimentações associadas.');
        }
    }

}
