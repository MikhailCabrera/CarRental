<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.unique' => 'This category already exists.',
            'category_name.max' => 'Category name cannot exceed 255 characters.'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect('/categories')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.unique' => 'This category already exists.',
            'category_name.max' => 'Category name cannot exceed 255 characters.'
        ]);

        $category->update([
            'category_name' => $request->category_name
        ]);

        return redirect('/categories')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted successfully!');
    }
}