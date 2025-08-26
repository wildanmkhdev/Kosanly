<?php

namespace App\Repositories;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
  public function getAllBoardingHouses($search = null, $city = null, $category = null)
  {
    $query = BoardingHouse::query();
    if ($search) {
      $query->where('name', 'like', '%' . $search . '%');
    }
    if ($city) {
      $query->whereHas('city', function (Builder $query) use ($city) {
        $query->where('slug', $city);
      });
    }
    if ($category) {
      $query->whereHas('category', function (Builder $query) use ($category) {
        $query->where('slug', $category);
      });
    }
    return $query->get();
  }

  public function getPopularBoardingHouses($limit = 5)
  {
    return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc')->take($limit)->get();
  }

  public function getBoardingHouseByCitySLug($slug)
  {
    return BoardingHouse::wherehas('city', function (Builder $query) use ($slug) {
      $query->where('slug', $slug);
    })->get();
  }
  public function getBoardingHouseByCategorySLug($slug)
  {
    return BoardingHouse::wherehas('category', function (Builder $query) use ($slug) {
      $query->where('slug', $slug);
    })->get();
  }

  public function getBoardingHouseBySLug($slug)
  {
    return BoardingHouse::where('slug', $slug)->fisrt();
  }
}
