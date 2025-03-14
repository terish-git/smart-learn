<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories($businessTypeId)
    {
        return $this->categoryRepository->getCategoriesByBusinessType($businessTypeId);
    }

    public function createCategory($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function getCategoriesByBusinessType($businessTypeId)
    {
        return $this->categoryRepository->getCategoriesByBusinessType($businessTypeId);
    }

    public function getChildCategoriesByParentId($parentId)
    {
        return $this->categoryRepository->getChildCategoriesByParentId($parentId);
    }

    public function getAllParentsOfCategory($categoryId)
    {
        return $this->categoryRepository->getAllParentsOfCategory($categoryId);
    }

    // public function getAllChildrenOfCategory($categoryId)
    // {
    //     return $this->categoryRepository->getAllChildrenOfCategory($categoryId);
    // }
}
