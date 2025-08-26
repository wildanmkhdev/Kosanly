<?php

namespace App\interfaces;

interface CategoryRepositoryInterface
{
  public function getAllCategories();
  public function getCategoryBySlug($slug);
}
