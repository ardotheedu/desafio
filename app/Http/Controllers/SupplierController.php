<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('suppliers.index', compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'document' => 'required|unique:suppliers',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        if (!$this->validateCpfCnpj($validated['document'])) {
            return redirect()->back()->withErrors(['document' => 'Documento inválido.'])->withInput();
        }

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Fornecedor criado com sucesso.');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'document' => 'required|unique:suppliers,document,' . $supplier->id,
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        if (!$this->validateCpfCnpj($validated['document'])) {
            return redirect()->back()->withErrors(['document' => 'Documento inválido.'])->withInput();
        }

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Fornecedor atualizado com sucesso.');
    }


    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')
            ->with('success', 'Fornecedor removido com sucesso.');
    }

    private function validateCpfCnpj($document)
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        if (strlen($document) === 11) {
            return $this->validateCpf($document);
        }


        if (strlen($document) === 14) {
            return $this->validateCnpj($document);
        }

        return false;
    }

    private function validateCpf($cpf)
    {

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;


        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;


        return $cpf[9] == $digito1 && $cpf[10] == $digito2;
    }

    private function validateCnpj($cnpj)
    {

        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        $soma = 0;
        $peso = 5;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $peso;
            $peso = $peso == 2 ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        $soma = 0;
        $peso = 6;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $peso;
            $peso = $peso == 2 ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;


        return $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
    }
}
