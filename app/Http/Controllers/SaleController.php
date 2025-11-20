<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Category;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        // Retrieve sales associated with the authenticated user
        $sales = Sale::where('user_id', auth()->id())->get();

        return view('sale.index', ['sales' => $sales]);
    }

    public function create()
    {
        return view('sale.create', [
            'categories' => Category::where('user_id', auth()->id())->select(['id', 'name'])->get(),
            'suppliers' => Supplier::where('user_id', auth()->id())->select(['id', 'name'])->get(),
        ]);
    }
}
