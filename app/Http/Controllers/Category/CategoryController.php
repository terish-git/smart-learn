<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getCategories($request->business_type_id);
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_type_id' => 'required|exists:business_types,id',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = $this->categoryService->createCategory($request->all());
        return response()->json(['message' => 'Category created successfully', 'category' => $category]);
    }


    

    // Get all categories by business_type_id
    public function getCategoriesByBusinessType(Request $request)
    {
        $request->validate(['business_type_id' => 'required|exists:business_types,id']);
        $categories = $this->categoryService->getCategoriesByBusinessType($request->business_type_id);
        return response()->json($categories);
    }

    // Get all child categories of parent_id
    public function getChildCategoriesByParentId(Request $request)
    {
        $request->validate(['parent_id' => 'required|exists:categories,id']);
        $categories = $this->categoryService->getChildCategoriesByParentId($request->parent_id);
        return response()->json($categories);
    }

    // Get all parent categories of a given category ID
    public function getAllParentsOfCategory(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:categories,id']);
        $categories = $this->categoryService->getAllParentsOfCategory($request->category_id);
        return response()->json($categories);
    }

    // Get all child categories of a given category ID (recursive)
    public function getAllChildrenOfCategory(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:categories,id']);
        $categories = $this->categoryService->getAllChildrenOfCategory($request->category_id);
        return response()->json($categories);
    }
}
