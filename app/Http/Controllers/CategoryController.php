<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    protected $categoryService;

     public function __construct(CategoryService $categoryService)
     {
         $this->categoryService = $categoryService;
     }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return Inertia::render('Categories/Index', ['categories' => $categories]);
    }

    public function store(CategoryRequest $request)
    {
        $category = $request->validated();
        $this->categoryService->create($category);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $request->validated();
        $this->categoryService->update($id, $category);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
