<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{

    public function __construct(protected CategoryService $categoryService)
    {
        //
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getAllCategoriesWithPagination();

        return CategoryResource::collection($categories);
    }
}
