<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Symfony\Contracts\Service\Attribute\Required;
class ProductController extends Controller
{
public function index()
{
    $products = Product::with('category')->get();
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'retailcost' => 'required|numeric',
        'category_id' => 'required'
    ]);

    Product::create([
        'name' => $request->name,
        'retailcost' => $request->retailcost,
        'category_id' => $request->category_id
    ]);

    return redirect()->back();
}
    
    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'retailcost' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);
        
        $product->update([
            'name' => $request->name,
            'retailcost' => $request->retailcost,
            'category_id' => $request->category_id
        ]);
        
        return redirect('/rental-costs');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/rental-costs');
    }
}
