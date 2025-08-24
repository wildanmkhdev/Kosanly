<?php

namespace App\Repositories;

use App\interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
  public function getAllCategories()
  {
    return Category::all();
  }
}
