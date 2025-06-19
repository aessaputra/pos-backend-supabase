<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function getAllCategoriesWithPagination(int $perPage = 15): LengthAwarePaginator
    {
        return Category::query()->latest()->paginate($perPage);
    }
}
