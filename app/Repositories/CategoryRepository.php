<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    
    /**
     * Get all categories by business_type_id in a tree structure
     */
    public function getCategoriesByBusinessType($businessTypeId)
    {
        return Category::where('business_type_id', $businessTypeId)
            ->whereNull('parent_id')
            ->with('subcategories') // Recursive relationship
            ->get();
    }

    /**
     * Get all child categories of a given parent_id recursively
     */
    public function getChildCategoriesByParentId($parentId)
    {
        return Category::where('parent_id', $parentId)
            ->with('subcategories') // Recursive relationship
            ->get();
    }

    /**
     * Get all parents (ancestry) of a given category ID
     */
    public function getAllParentsOfCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $parents = [];

        while ($category && $category->parent_id) {
            $category = $category->parent;
            if ($category) {
                $parents[] = $category;
            }
        }

        return array_reverse($parents); // Reverse to get top-down order
    }

    /**
     * Get full category tree structure for a given category
     */
    public function getCategoryTree($categoryId)
    {
        return Category::where('id', $categoryId)
            ->with('subcategories') // Recursive relationship
            ->first();
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }
}
