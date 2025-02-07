<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    public function index()
    {
        $movements = Movement::with(['product', 'supplier' => function($query) {
            $query->withTrashed();
        }])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('movements.index', compact('movements'));
    }

}
