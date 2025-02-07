<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('stock.index', compact('products'));
    }

    public function createIn(Product $product)
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('stock.in', compact('product', 'suppliers'));
    }

    public function storeIn(Request $request, Product $product)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable',
        ]);

        DB::transaction(function () use ($validated, $product) {
            $total_price = $validated['quantity'] * $validated['unit_price'];

            Movement::create([
                'type' => 'in',
                'product_id' => $product->id,
                'supplier_id' => $validated['supplier_id'],
                'quantity' => $validated['quantity'],
                'unit_price' => $validated['unit_price'],
                'total_price' => $total_price,
                'notes' => $validated['notes'] ?? null,
            ]);

            $newAveragePrice = $this->calculateNewAveragePrice(
                $product,
                $validated['quantity'],
                $validated['unit_price']
            );

            $product->update([
                'stock' => $product->stock + $validated['quantity'],
                'average_price' => $newAveragePrice
            ]);
        });

        return redirect()->route('stock.index')
            ->with('success', 'Entrada registrada com sucesso.');
    }

    public function createOut(Product $product)
    {
        return view('stock.out', compact('product'));
    }

    public function storeOut(Request $request, Product $product)
    {
        $validated = $request->validate([
            'destination' => 'required|string',
            'quantity' => "required|integer|min:1|max:{$product->stock}",
            'notes' => 'nullable',
        ]);

        DB::transaction(function () use ($validated, $product) {
            Movement::create([
                'type' => 'out',
                'product_id' => $product->id,
                'destination' => $validated['destination'],
                'quantity' => $validated['quantity'],
                'unit_price' => $product->average_price,
                'total_price' => $product->average_price * $validated['quantity'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $product->update([
                'stock' => $product->stock - $validated['quantity']
            ]);
        });

        return redirect()->route('stock.index')
            ->with('success', 'Saída registrada com sucesso.');
    }

    private function calculateNewAveragePrice($product, $newQuantity, $newPrice)
    {
        $currentValue = $product->stock * $product->average_price;
        $newValue = $newQuantity * $newPrice;
        $totalQuantity = $product->stock + $newQuantity;

        return $totalQuantity > 0 ? ($currentValue + $newValue) / $totalQuantity : $newPrice;
    }
}
