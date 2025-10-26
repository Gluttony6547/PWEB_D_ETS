<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // READ: Display all categories
    public function index()
    {
        $categories = Category::withCount('tasks')->get();
        return view('categories.index', compact('categories'));
    }

    // CREATE: Show form
    public function create()
    {
        return view('categories.create');
    }

    // CREATE: Store category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'color' => 'required',
            'description' => 'nullable'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    // UPDATE: Show form
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // UPDATE: Update category
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'color' => 'required',
            'description' => 'nullable'
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // DELETE: Delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}